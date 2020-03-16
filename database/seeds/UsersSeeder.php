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

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->truncate();

        $data = [
            [
                'id'          => 'eyJ0eXAiOiJKV1QiLCJhb7',
                'username'    => 'covidreporter',
                'name'        => 'Covid Reporter',
                'email'       => 'survivorz@survivecorona.how',
                'password'    => Hash::make('123456'),
                'created_at'  => '2020-03-16 00:33:33',
                'updated_at'  => '2020-03-16 00:33:33',
            ],
        ];

        DB::table('users')
            ->insert($data);
    }
}
