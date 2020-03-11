<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOneOrMany;

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
class CovidCase extends Model
{
    protected $table = 'cases';

    public function symptoms(): HasManyThrough
    {
        return $this->hasManyThrough(CaseSymptom::class, Symptom::class);
    }
}
