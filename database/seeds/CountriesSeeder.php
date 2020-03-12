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

class CountriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('countries')->truncate();

        $data = [
            [
                'id'         => 'eyJ0eXAiOiJKV1QiLCJhHH',
                'name'       => 'Italy',
                'continent'  => 'Europe',
                'created_at' => '2020-03-10 20:44:00',
                'updated_at' => '2020-03-10 20:44:00',
            ],
        ];

        DB::table('countries')
            ->insert($data);
    }
}
