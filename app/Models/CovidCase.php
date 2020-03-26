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
 * @property string      $id                  UUID of case numbers per region
 * @property string      $region_id           UUID of the region
 * @property string      $severity            ENUM [active, serious, recovered, dead, unknown]
 * @property Carbon      $logged_at
 * @property Carbon      $infected_at
 * @property Carbon      $recovered_at
 * @property Carbon      $symptoms_started_at
 * @property Symptom[]   $symptoms
 * @property Carbon      $created_at
 * @property Carbon      $updated_at
 */
class CovidCase extends ConciseUuidModel
{
    protected $table = 'cases';

    public function symptoms()
    {
        return $this->belongsToMany(
            Symptom::class,
            'case_symptoms',
            'case_id',
            'symptom_id',
        );
    }

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function getCountryAttribute()
    {
        return Country::query()
            ->whereIn('id', function (DB_Builder $query) {
                return $query->select('country_id')
                    ->from('regions')
                    ->whereIn('id', function (DB_Builder $query) {
                        return $query->select('region_id')
                            ->from('cases')
                            ->where(['id' => $this->id]);
                    });
            })->get();
    }
}
