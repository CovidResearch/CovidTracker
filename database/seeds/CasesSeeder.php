<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CasesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cases')->truncate();

        $data = [
            [
                'id'                  => 'iVo76KFwHkAbpZf39MiSG3',
                'region_id'           => 'eyJ0eXAiOiJKV1QiLCJhII',
                'severity'            => 'severe',
                'logged_at'           => '2020-02-11 00:00:00',
                'infected_at'         => '2020-02-05 00:00:00',
                'recovered_at'        => '2020-02-25 00:00:00',
                'symptoms_started_at' => '2020-02-15 00:00:00',
                'created_at'          => '2020-03-10 20:44:00',
                'updated_at'          => '2020-03-10 20:44:00',
            ],
        ];

        DB::table('cases')
            ->insert($data);
    }
}
