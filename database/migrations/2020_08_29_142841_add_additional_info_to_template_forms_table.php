<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAdditionalInfoToTemplateFormsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('template_forms', function (Blueprint $table) {
            $table->json('additional_info')->after('term_condition')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('template_forms', function (Blueprint $table) {
            $table->dropColumn('additional_info');
        });
    }
}
