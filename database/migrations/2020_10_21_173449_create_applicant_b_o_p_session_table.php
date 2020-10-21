<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicantBOPSessionTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('applicant_b_o_p_session', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('applicant_id')->unsigned()->nullable();
            $table->foreign('applicant_id')->references('id')->on('applicants');
            $table->bigInteger('b_o_p_session_id')->unsigned()->nullable();
            $table->foreign('b_o_p_session_id')->references('id')->on('b_o_p_sessions');
            $table->enum('attendance_status', ['invited', 'present', 'absent']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('applicant_b_o_p_session');
    }
}
