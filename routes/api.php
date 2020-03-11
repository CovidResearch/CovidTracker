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

use App\Http\Controllers\CaseController;
use App\Http\Controllers\Cases;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->namespace('Api\V1')->group(function () {
    Route::middleware(['auth:api', 'verified'])->group(function () {
        // Data Viewing
        Route::apiResource('cases', CaseController::class);
        Route::apiResource('cases/recovered', Cases\RecoveredController::class);
        Route::apiResource('cases/deaths', Cases\DeathController::class);
        Route::apiResource('cases/active', Cases\ActiveController::class);
        Route::apiResource('cases/serious', Cases\SevereController::class);



        // Comments
        Route::apiResource('comments', 'CommentController')->only('destroy');

        // Users
        Route::apiResource('users', 'UserController')->only('update');

        // Media
        Route::apiResource('media', 'MediaController')->only(['store', 'destroy']);
    });

    Route::post('/authenticate', 'Auth\AuthenticateController@authenticate')->name('authenticate');

    // Comments
    Route::apiResource('posts.comments', 'PostCommentController')->only('index');
    Route::apiResource('users.comments', 'UserCommentController')->only('index');
    Route::apiResource('comments', 'CommentController')->only(['index', 'show']);

    // Users
    Route::apiResource('users', 'UserController')->only(['index', 'show']);

    // Media
    Route::apiResource('media', 'MediaController')->only('index');
});

