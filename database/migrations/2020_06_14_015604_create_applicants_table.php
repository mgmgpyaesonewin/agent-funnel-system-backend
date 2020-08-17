<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// 2020_06_14_015604
class CreateApplicantsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('applicants', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('temp_id')->unique()->nullable();
            $table->string('name');
            $table->string('phone');
            $table->date('dob');
            $table->tinyInteger('gender');
            $table->string('preferred_name')->nullable();
            $table->string('nrc')->nullable();
            $table->string('nrc_front_img')->nullable();
            $table->string('nrc_back_img')->nullable();
            $table->boolean('myanmar_citizen')->default(1);
            $table->string('citizen')->nullable();
            $table->string('race')->nullable();
            $table->string('married')->nullable();
            $table->string('address')->nullable();
            $table->integer('city_id')->nullable();
            $table->integer('township_id')->nullable();
            $table->string('secondary_phone')->nullable();
            $table->string('education')->nullable();
            $table->string('email')->nullable();
            $table->boolean('accept_t_n_c')->default(1);
            $table->string('spouse_name')->nullable();
            $table->string('spouse_nrc')->nullable();
            $table->string('spouse_occupation')->nullable();
            $table->string('spouse_company_name')->nullable();
            $table->json('prudential_agency_exp')->nullable();
            $table->json('employment')->nullable();
            $table->json('agent_exp')->nullable();
            $table->json('family_agent')->nullable();
            $table->string('utm_source')->nullable();
            $table->string('utm_medium')->nullable();
            $table->string('utm_campaign')->nullable();
            $table->string('utm_term')->nullable();
            $table->enum('current_status', ['pre_filter', 'pru_dna_test', 'pmli_filter', 'training', 'certification', 'onboard', 'active']);

            $table->bigInteger('status_id')->unsigned()->nullable();
            $table->foreign('status_id')->references('id')->on('statuses');

            $table->bigInteger('assign_admin_id')->unsigned()->nullable();
            $table->foreign('assign_admin_id')->references('id')->on('users');

            $table->bigInteger('assign_bdm_id')->unsigned()->nullable();
            $table->foreign('assign_bdm_id')->references('id')->on('users');

            $table->bigInteger('assign_ma_id')->unsigned()->nullable();
            $table->foreign('assign_ma_id')->references('id')->on('users');

            $table->bigInteger('assign_staff_id')->unsigned()->nullable();
            $table->foreign('assign_staff_id')->references('id')->on('users');

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
