<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RegionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('regions')->truncate();

        $data = [
            [
                'id'         => 'eyJ0eXAiOiJKV1QiLCJhII',
                'name'       => 'Lombardy',
                'country_id' => 'eyJ0eXAiOiJKV1QiLCJhHH',
                'created_at' => '2020-03-10 20:44:00',
                'updated_at' => '2020-03-10 20:44:00',
            ],
        ];

        DB::table('regions')
            ->insert($data);
    }
}
