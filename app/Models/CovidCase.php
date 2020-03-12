<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Query\Builder as DB_Builder;
use PHPExperts\ConciseUuid\ConciseUuidModel;

/**
 * @property string      $id           UUID of case numbers per region
 * @property string      $region_id    UUID of the region
 * @property string      $severity     ENUM [active, serious, recovered, dead, unknown]
 * @property Carbon      $logged_at
 * @property Carbon      $infected_at
 * @property Carbon      $recovered_at
 * @property Carbon      $symptoms_started_at
 * @property CaseSymptom $symptoms
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
