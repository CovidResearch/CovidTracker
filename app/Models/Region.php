<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use PHPExperts\ConciseUuid\ConciseUuidModel;

/**
 * @property string      $id           UUID of case numbers per region
 * @property string      $name
 * @property string      $country_id   UUID of the region's country
 * @property Carbon      $created_at
 * @property Carbon      $updated_at
 */
class Region extends ConciseUuidModel
{
    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }
}
