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

Broadcast::channel('App.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});
