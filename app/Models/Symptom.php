<?php

namespace App\Models;

use Carbon\Carbon;
use PHPExperts\ConciseUuid\ConciseUuidModel;

/**
 * @property string $id           UUID of the symptom
 * @property string $name         UUID
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Symptom extends ConciseUuidModel
{
    public function cases()
    {
        return $this->belongsToMany(
            CovidCase::class,
            'case_symptoms',
            'symptom_id',
            'case_id',
        );
    }
}
