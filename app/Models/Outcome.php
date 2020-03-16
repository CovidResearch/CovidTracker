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

use Illuminate\Database\Eloquent\Model;
use PHPExperts\ConciseUuid\ConciseUuidModel;

/**
 * @property string $id   UUID of the outcome
 * @property string $name UUID
 */
class Outcome extends ConciseUuidModel
{
    public const UNKNOWN   = 'unknown';
    public const ACTIVE    = 'active';
    public const DIED      = 'died';
    public const DISABLED  = 'disabled';
    public const RECOVERED = 'recovered';
    public const SERIOUS   = 'serious';

    public const ALL = [
        self::UNKNOWN,
        self::ACTIVE,
        self::SERIOUS,
        self::RECOVERED,
        self::DISABLED,
        self::DIED,
    ];
}
