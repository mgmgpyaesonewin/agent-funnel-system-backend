<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAmlCheckToApplicantsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('applicants', function (Blueprint $table) {
            $table->integer('aml_check')->after('exam_date')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('applicants', function (Blueprint $table) {
            $table->dropColumn('aml_check');
        });
    }
}
