<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SymptomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'id'          => 'eyJ0eXAiOiJKV1QiLCJhb8',
                'name'        => 'cough',
                'created_at'  => '2020-03-10 20:49:45',
                'updated_at'  => '2020-03-10 20:49:45',
            ],
            [
                'id'          => 'eyJ0eXAiOiJKV1QiLCJhb9',
                'name'        => 'aches',
                'created_at'  => '2020-03-10 20:49:45',
                'updated_at'  => '2020-03-10 20:49:45',
            ],
        ];

        DB::table('symptoms')
            ->insert($data);
    }
}
