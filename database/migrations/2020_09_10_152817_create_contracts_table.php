<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContractsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('contracts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('pdf')->nullable();
            $table->string('agreement_no')->nullable();
            $table->dateTime('signed_date')->nullable();
            $table->string('applicant_sign_img')->nullable();
            $table->string('witness_name')->nullable();
            $table->string('witness_sign_img')->nullable();
            $table->integer('version');
            $table->bigInteger('applicant_id')->unsigned();
            $table->foreign('applicant_id')->references('id')->on('applicants');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('contracts');
    }
}
