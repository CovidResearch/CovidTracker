<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CaseSymptomsSeeder extends Seeder
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
                'id'                  => 'iVo76KFwHkAbpZf39MiSG2',
                'region_id'           => 'eyJ0eXAiOiJKV1QiLCJhbG',
                'severity'            => 'severe',
                'started_at'          => '2020-02-05 00:00:00',
                'ended_at'            => '2020-02-23 00:00:00',
                'created_at'          => '2020-03-10 20:44:00',
                'updated_at'          => '2020-03-10 20:44:00',
            ],
        ];

        DB::table('cases')
            ->insert($data);
    }
}
