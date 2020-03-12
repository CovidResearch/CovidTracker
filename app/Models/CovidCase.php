<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOneOrMany;
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
}
