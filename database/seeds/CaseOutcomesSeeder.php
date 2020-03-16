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

use App\Models\CovidCase;
use App\Models\Outcome;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use PHPExperts\ConciseUuid\ConciseUuid;

class CaseOutcomesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('case_outcomes')->truncate();

        $recoveredCase = CovidCase::query()->create([
            'region_id'           => 'eyJ0eXAiOiJKV1QiLCJhII',
            'severity'            => 'serious',
            'logged_at'           => '2020-02-05 00:00:00',
            'infected_at'         => '2020-02-01 00:00:00',
            'recovered_at'        => '2020-03-12 00:00:00',
            'symptoms_started_at' => '2020-02-05 00:00:00',
            'created_at'          => '2020-03-12 13:21:00',
            'updated_at'          => '2020-03-12 13:21:00',
        ]);


        $firstCaseId = CovidCase::query()->first()->id;
        $data = [
            [
                'id'         => ConciseUuid::generateNewId(),
                'case_id'    => $firstCaseId,
                'outcome_id' => Outcome::query()->where(['name' => 'active'])->first()->id,
                'created_at' => '2020-02-05',
            ],
            [
                'id'         => ConciseUuid::generateNewId(),
                'case_id'    => $firstCaseId,
                'outcome_id' => Outcome::query()->where(['name' => 'serious'])->first()->id,
                'created_at' => '2020-02-14',
            ],
            [
                'id'         => ConciseUuid::generateNewId(),
                'case_id'    => $firstCaseId,
                'outcome_id' => Outcome::query()->where(['name' => 'died'])->first()->id,
                'created_at' => '2020-03-06',
            ],

            [
                'id'         => ConciseUuid::generateNewId(),
                'case_id'    => $recoveredCase->id,
                'outcome_id' => Outcome::query()->where(['name' => 'active'])->first()->id,
                'created_at' => '2020-02-05',
            ],
            [
                'id'         => ConciseUuid::generateNewId(),
                'case_id'    => $recoveredCase->id,
                'outcome_id' => Outcome::query()->where(['name' => 'serious'])->first()->id,
                'created_at' => '2020-02-10',
            ],
            [
                'id'         => ConciseUuid::generateNewId(),
                'case_id'    => $recoveredCase->id,
                'outcome_id' => Outcome::query()->where(['name' => 'unknown'])->first()->id,
                'created_at' => '2020-02-15',
            ],
            [
                'id'         => ConciseUuid::generateNewId(),
                'case_id'    => $recoveredCase->id,
                'outcome_id' => Outcome::query()->where(['name' => 'recovered'])->first()->id,
                'created_at' => '2020-03-05',
            ],
        ];

        DB::table('case_outcomes')
            ->insert($data);
    }
}
