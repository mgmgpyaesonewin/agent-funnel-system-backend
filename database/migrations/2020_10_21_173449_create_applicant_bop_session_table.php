<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicantBopSessionTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('applicant_bop_session', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('applicant_id')->unsigned()->nullable();
            $table->foreign('applicant_id')->references('id')->on('applicants');
            $table->bigInteger('bop_session_id')->unsigned()->nullable();
            $table->foreign('bop_session_id')->references('id')->on('bop_sessions');
            $table->enum('attendance_status', ['invited', 'present', 'absent']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('applicant_bop_session');
    }
}
