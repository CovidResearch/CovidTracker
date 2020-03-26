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

namespace App\Http\Controllers\Cases;

use App\Http\Controllers\Controller;
use App\Models\CovidCase;
use App\Models\Outcome;
use Illuminate\Http\JsonResponse;

class ActiveController extends Controller
{
    public function index()
    {
        $cases = CovidCase::query()
            ->where(['status' => Outcome::ACTIVE])
            ->orWhere(['status' => Outcome::SERIOUS])
            ->orderBy('created_at')
            ->get();

        return new JsonResponse($cases);
    }
}
