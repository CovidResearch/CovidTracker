<?php declare(strict_types=1);

/**
 * This file is part of Covid Tracker, a Covid Research Project.
 *
 * Copyright © 2020 Theodore R. Smith <theodore@phpexperts.pro>
 *   GPG Fingerprint: 4BF8 2613 1C34 87AC D28F  2AD8 EB24 A91D D612 5690
 *   https://www.phpexperts.pro/
 *   https://github.com/PHPExpertsInc/Skeleton
 *
 * This file is licensed under the MIT License.
 */

namespace App\Console\Commands;

use App\Models\Country;
use App\Models\CovidCase;
use App\Models\DailyRegionReport;
use App\Models\DTOs\CSSEData\CSSERegionReportDTO;
use App\Models\Region;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use PHPExperts\CSVSpeaker\CSVReader;
use PHPExperts\DataTypeValidator\InvalidDataTypeException;
use RuntimeException;
use SplFileInfo;

class UpdateStats extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'covid19:update-stats';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Parses the latest covid-19 updates into the db.';

    protected static $regions = [];

    protected static $regionCounts = [];

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $csvFiles = $this->fetchCSSEFiles();

        foreach ($csvFiles as $csvFile) {
            $csvFile = base_path("data/CSSEGISandData/csse_covid_19_data/csse_covid_19_daily_reports/$csvFile");
            $csseReports = $this->parseCSVFile($csvFile);
            // Delete all the day's previous reports and recalculate.
            $reportDate = $csseReports[0]->Last_Update->timezone('America/Chicago')->format('Y-m-d');
            DailyRegionReport::query()
                ->where(['date' => $reportDate])
                ->delete();
            self::$regionCounts = [];

            foreach ($csseReports as $csseReport) {
                $this->recordReport($csseReport);
            }
//            break;
        }
    }

    protected function recordReport(CSSERegionReportDTO $regionReport)
    {
        // Load the country.
        $country = $this->fetchOrAddCountry($regionReport->Country_Region);
        $region = $this->fetchOrAddRegion($regionReport->Province_State, $country);

        $confirmed =& self::$regionCounts[$region->id]['confirmed'];
        $active    =& self::$regionCounts[$region->id]['active'];
        $recovered =& self::$regionCounts[$region->id]['recovered'];
        $dead      =& self::$regionCounts[$region->id]['dead'];

        $confirmed += $regionReport->Confirmed;
        $active    += $regionReport->Active;
        $recovered += $regionReport->Recovered;
        $dead      += $regionReport->Deaths;

        dump([
            'date'        => $regionReport->Last_Update->timezone('America/Chicago')->format('Y-m-d'),
            'region_id'   => $region->id,
            'region_name' => $region->name . ", {$country->name}",
            'confirmed'   => $regionReport->Confirmed,
            'active'      => $regionReport->Active,
            'recovered'   => $regionReport->Recovered,
            'dead'        => $regionReport->Deaths,
        ]);

        $regionReport = DailyRegionReport::query()->updateOrCreate([
            'date'        => $regionReport->Last_Update->timezone('America/Chicago')->format('Y-m-d'),
            'region_id'   => $region->id,
            'region_name' => $region->name . ", {$country->name}",
        ],
        [
            'confirmed'   => $confirmed,
            'active'      => $active,
            'recovered'   => $recovered,
            'dead'        => $dead,
        ]);
    }

    protected function fetchCSSEFiles()
    {
        $dir = base_path('data/CSSEGISandData/csse_covid_19_data/csse_covid_19_daily_reports');

        return $files = array_values(collect(File::allFiles($dir))
            ->filter(function (SplFileInfo $file) {
                return in_array($file->getExtension(), ['csv']);
            })
            ->sortByDesc(function (SplFileInfo $file) {
                return $file->getBasename();
            })
            ->map(function (SplFileInfo $file) {
                return $file->getBaseName();
            })->toArray());
    }

    /**
     * @param string $csvFile
     * @return CSSERegionReportDTO[]
     */
    protected function parseCSVFile(string $csvFile): array
    {
        if (!is_readable($csvFile)) {
            throw new RuntimeException("Cannot open $csvFile for processing.");
        }

        $fileModTime = filemtime($csvFile);
        $csv = CSVReader::fromFile($csvFile);
        $data = $csv->toArray();
        $csseReports = [];

        foreach ($data as $reportInfo) {
            try {
                dump($reportInfo);
                // Type coercions
                // United States regions
                if (!empty($reportInfo['Lat'])) {
                    $reportInfo['Latitude'] = (float)$reportInfo['Lat'];
                    $reportInfo['Longitude'] = (float)$reportInfo['Long_'];
                    unset($reportInfo['Lat']);
                    unset($reportInfo['Long_']);
                }

                if (!empty($reportInfo['Country/Region'])) {
                    $reportInfo['Province_State'] = $reportInfo['Province/State'];
                    $reportInfo['Country_Region'] = $reportInfo['Country/Region'];
                    unset($reportInfo['Province/State']);
                    unset($reportInfo['Country/Region']);
                }
                $reportInfo['Confirmed'] = (int) $reportInfo['Confirmed'];
                $reportInfo['Deaths'] = (int) $reportInfo['Deaths'];
                $reportInfo['Recovered'] = (int) $reportInfo['Recovered'];
                if (array_key_exists('Active', $reportInfo)) {
                    $reportInfo['Active'] = (int)$reportInfo['Active'];
                } else {
                    $reportInfo['Active'] = null;
                }

                $csseReports[] = new CSSERegionReportDTO($reportInfo);
            } catch (InvalidDataTypeException $e) {
                dump($reportInfo);
                dd($e->getReasons());
            }
        }

        return $csseReports;
    }

    protected function fetchOrAddCountry(string $countryName): Country
    {
        if (empty(self::$regions[$countryName])) {
            $country = Country::fetchOrCreate($countryName);
            self::$regions[$countryName] = $country;
        }

        return self::$regions[$countryName];
    }

    protected function fetchOrAddRegion(string $regionName, Country $country): Region
    {
        if ($regionName === '') {
            $regionName = '(All)';
        }

        if (empty(self::$regions[$country->name][$regionName])) {
            $region = Region::fetchOrCreate($regionName, $country->id);
            self::$regions[$country->name][$regionName] = $region;
        }

        return self::$regions[$country->name][$regionName];
    }
}
