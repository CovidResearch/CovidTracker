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
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use PHPExperts\ConciseUuid\ConciseUuidModel;

/**
 * @property string $id         UUID of case numbers per region
 * @property string $name
 * @property string $country_id UUID of the region's country
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Region extends ConciseUuidModel
{
    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }
}
