<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property string $id           UUID
 * @property string $symptomId    UUID
 * @property int    $severity     Scale of 0 to 10
 * @property Carbon $started_at
 * @property Carbon $ended_at
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class CaseSymptom extends Model
{
    public function symptom(): HasMany
    {
        return $this->hasMany(Symptom::class);
    }
}
