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

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Query\Builder as DB_Builder;
use PHPExperts\ConciseUuid\ConciseUuidModel;

/**
 * @property string      $id         UUID of case numbers per region
 * @property string      $name
 * @property string      $continent
 * @property CovidCase[] $cases
 * @property Carbon      $created_at
 * @property Carbon      $updated_at
 */
class Country extends ConciseUuidModel
{
    protected $guarded = ['id', 'created_at'];

    public function cases()
    {
        return CovidCase::query()
            ->whereIn('region_id', function (DB_Builder $query) {
                return $query->select('id')
                    ->from('regions')
                    ->where(['country_id' => $this->id]);
            })->get();
    }

    public function getCasesAttribute()
    {
        return $this->cases();
    }

    public static function fetchOrCreate(string $countryName): self
    {
        $country = self::query()
            ->where(['name' => $countryName])
            ->first();

        if (!$country) {
            /** @var self $country */
            $country = self::query()->create([
                'name' => $countryName,
            ]);
        }

        return $country;
    }
}
