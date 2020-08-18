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
            $table->string('template_name');
            $table->boolean('preferred_name');
            $table->boolean('name');
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
            $table->boolean('highest_qualification');
            $table->boolean('email');
            $table->boolean('conflict_interest');
            $table->boolean('term_condition');
            $table->boolean('active')->default(false);
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
