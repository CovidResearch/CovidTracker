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

use App\Models\Outcome;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use PHPExperts\ConciseUuid\ConciseUuid;

class VersionOnePointOh extends Migration
{
    /**
     * Run the migrations.
     * @todo This probably really needs microtime dates for the cases, as at a certain
     *       dreadful moment, more than one per second will start flooding in. :-/
     */
    public function up(): void
    {
        // Create PostgreSQL enums.
        // active, serious, recovered, dead, unknown
        $query = "CREATE TYPE outcome AS ENUM('" . implode("', '", Outcome::ALL) . "');";
        DB::statement($query);

        Schema::create('symptoms', function (Blueprint $table) {
            $table->char('id', 22)->primary();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('countries', function (Blueprint $table) {
            $table->char('id', 22)->primary();
            $table->string('name');
            $table->string('continent');
            $table->timestamps();
        });

        Schema::create('regions', function (Blueprint $table) {
            $table->char('id', 22)->primary();
            $table->string('name');
            $table->char('country_id', 22);
            $table->timestamps();

            $table->foreign('country_id')
                ->references('id')
                ->on('countries');
        });



        Schema::create('cases', function (Blueprint $table) {
            $table->char('id', 22)->primary();
            $table->char('region_id', 22);
            $table->string('severity')->nullable();
            $table->dateTime('logged_at');
            $table->dateTime('infected_at')->nullable();
            $table->dateTime('recovered_at')->nullable();
            $table->dateTime('symptoms_started_at')->nullable();
            $table->timestamps();

            $table->foreign('region_id')
                ->references('id')
                ->on('regions');
        });

        Schema::create('case_symptoms', function (Blueprint $table) {
            $table->char('case_id', 22);
            $table->char('symptom_id', 22);
            $table->integer('severity')->nullable();
            $table->dateTime('started_at')->nullable();
            $table->dateTime('ended_at')->nullable();

            $table->timestamps();

            $table->index('severity');

            $table->foreign('case_id')
                ->references('id')
                ->on('cases');
            $table->foreign('symptom_id')
                ->references('id')
                ->on('symptoms');
        });

        Schema::create('outcomes', function (Blueprint $table) {
            $table->char('id', 22)->primary();
            $table->string('name');
        });

        $outcomes = [];
        foreach (Outcome::ALL as $outcome) {
            $outcomes[] = [
                'id'   => ConciseUuid::generateNewId(),
                'name' => $outcome,
            ];
        }

        DB::table('outcomes')
            ->insert($outcomes);

        Schema::create('case_outcomes', function (Blueprint $table) {
            $table->char('id', 22)->primary();
            $table->char('case_id', 22);
            $table->char('outcome_id', 22);
            $table->timestamp('created_at', 0)->nullable();

            $table->foreign('case_id')
                ->references('id')
                ->on('cases');

            $table->foreign('outcome_id')
                ->references('id')
                ->on('outcomes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('case_outcomes');
        Schema::dropIfExists('outcomes');
        Schema::dropIfExists('case_symptoms');
        Schema::dropIfExists('cases');
        Schema::dropIfExists('regions');
        Schema::dropIfExists('countries');
        Schema::dropIfExists('symptoms');

        DB::statement("DROP TYPE IF EXISTS outcome;");
    }
}
