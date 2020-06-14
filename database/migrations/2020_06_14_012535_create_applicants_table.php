<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicantsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('applicants', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('photo');
            $table->string('nrc');
            $table->date('dob');
            $table->tinyInteger('gender');
            $table->string('phone');
            $table->string('email');
            $table->string('address');
            $table->json('education');
            $table->json('working_experience');
            $table->tinyInteger('is_chatesat_freelancer');
            $table->string('referral_code');
            $table->string('cv_attachment');
            $table->tinyInteger('is_webinar_available');
            $table->tinyInteger('is_training_available');
            $table->tinyInteger('is_prudential_available');
            $table->bigInteger('status_id');
            $table->bigInteger('reason_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('applicants');
    }
}
