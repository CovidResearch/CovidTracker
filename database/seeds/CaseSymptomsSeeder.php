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
        DB::table('case_symptoms')->truncate();

        $data = [
            [
                'id'         => 'iVo76KFwHkAbpZf39MiSG2',
                'case_id'    => 'iVo76KFwHkAbpZf39MiSG3',
                'symptom_id' => 'eyJ0eXAiOiJKV1QiLCJhb8',
                'severity'   => 8,
                'started_at' => '2020-02-05 00:00:00',
                'ended_at'   => '2020-02-23 00:00:00',
                'created_at' => '2020-03-10 20:44:00',
                'updated_at' => '2020-03-10 20:44:00',
            ],
            [
                'id'         => 'iVo76KFwHkAbpZf39MiSG4',
                'case_id'    => 'iVo76KFwHkAbpZf39MiSG3',
                'symptom_id' => 'eyJ0eXAiOiJKV1QiLCJhb9',
                'severity'   => 8,
                'started_at' => '2020-02-04 00:00:00',
                'ended_at'   => '2020-02-22 00:00:00',
                'created_at' => '2020-03-10 20:44:00',
                'updated_at' => '2020-03-10 20:44:00',
            ],
        ];

        DB::table('case_symptoms')
            ->insert($data);
    }
}
