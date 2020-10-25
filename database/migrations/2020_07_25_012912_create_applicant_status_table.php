<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicantStatusTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('applicant_status', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('applicant_id')->unsigned()->nullable();
            $table->foreign('applicant_id')->references('id')->on('applicants');
            $table->bigInteger('status_id')->unsigned()->nullable();
            $table->foreign('status_id')->references('id')->on('statuses');
            $table->enum('current_status', ['pre_filter', 'bop_session', 'pru_dna_test', 'pmli_filter', 'training', 'certification', 'onboard', 'active', 'lead', 'waiting_payment']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('applicant_status');
    }
}
