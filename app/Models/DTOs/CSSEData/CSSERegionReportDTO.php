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

namespace App\Models\DTOs\CSSEData;

use Carbon\Carbon;
use PHPExperts\DataTypeValidator\DataTypeValidator;
use PHPExperts\SimpleDTO\SimpleDTO;

/**
 * @property string $FIPS           "45001"
 * @property string $Admin2         "Abbeville"
 * @property string $Province_State "South Carolina"
 * @property string $Country_Region "US"
 * @property Carbon $Last_Update    "2020-03-25 23:33:19"
 * @property float  $Latitude       "34.22333378"
 * @property float  $Longitude      "-82.46170658"
 * @property int    $Confirmed      "3"
 * @property int    $Deaths         "0"
 * @property int    $Recovered      "0"
 * @property null|int $Active         "0"
 * @property string $Combined_Key   "Abbeville, South Carolina, US"
 */
class CSSERegionReportDTO extends SimpleDTO
{
    public function __construct(array $input, array $options = [], DataTypeValidator $validator = null)
    {
        parent::__construct($input, [SimpleDTO::PERMISSIVE], $validator);
    }
}
