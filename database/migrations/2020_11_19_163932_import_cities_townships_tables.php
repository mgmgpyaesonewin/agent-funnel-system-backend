<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class ImportCitiesTownshipsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $sql_dump = file_get_contents(__DIR__.'/cities_townships.sql');
        DB::unprepared($sql_dump);
//        DB::connection()->getPdo()->exec($sql_dump);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('township_descriptions');
        Schema::dropIfExists('townships');
        Schema::dropIfExists('city_descriptions');
        Schema::dropIfExists('cities');
    }
}
