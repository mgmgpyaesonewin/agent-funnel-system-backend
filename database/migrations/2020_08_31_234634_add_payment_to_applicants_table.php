<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPaymentToApplicantsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('applicants', function (Blueprint $table) {
            $table->string('payment')->nullable()->after('aml_check');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('applicants', function (Blueprint $table) {
            $table->dropColumn('payment');
        });
    }
}
