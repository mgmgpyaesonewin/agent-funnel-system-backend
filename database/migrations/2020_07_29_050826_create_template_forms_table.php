<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTemplateFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('template_forms', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('preferred_name');
            $table->boolean('nrc');
            $table->boolean('nrc_photo');
            $table->boolean('dob');
            $table->boolean('gender');
            $table->boolean('myanmar_citizen');
            $table->boolean('citizenship');
            $table->boolean('race');
            $table->boolean('marital_status');
            $table->boolean('address');
            $table->boolean('city');
            $table->boolean('township');
            $table->boolean('contact_no');
            $table->boolean('alternate_no');
            $table->boolean('Highest Qualification');
            $table->boolean('email');
            $table->boolean('conflict_interest');
            $table->boolean('t_c');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('template_forms');
    }
}
