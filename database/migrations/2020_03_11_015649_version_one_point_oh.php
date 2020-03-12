<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class VersionOnePointOh extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
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
            $table->char('id', 22)->primary();
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
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('case_symptoms');
        Schema::dropIfExists('cases');
        Schema::dropIfExists('regions');
        Schema::dropIfExists('countries');
        Schema::dropIfExists('symptoms');
    }
}
