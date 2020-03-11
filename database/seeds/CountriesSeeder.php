<?php

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
