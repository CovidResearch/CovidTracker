<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Query\Builder as DB_Builder;
use PHPExperts\ConciseUuid\ConciseUuidModel;

/**
 * @property string      $id           UUID of case numbers per region
 * @property string      $name
 * @property string      $continent
 * @property CovidCase[] $cases
 * @property Carbon      $created_at
 * @property Carbon      $updated_at
 */
class Country extends ConciseUuidModel
{
    public function cases()
    {
        return CovidCase::query()
            ->whereIn('region_id', function (DB_Builder $query) {
                return $query->select('id')
                    ->from('regions')
                    ->where(['country_id' => $this->id]);
            })->get();
    }

    public function getCasesAttribute()
    {
        return $this->cases();
    }
}
