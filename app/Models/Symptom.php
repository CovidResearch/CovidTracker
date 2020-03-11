<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property string $id           UUID of the symptom
 * @property string $name         UUID
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Symptom extends Model
{
}
