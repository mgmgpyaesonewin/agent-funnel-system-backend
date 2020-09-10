<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAgreementNoToApplicantsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('applicants', function (Blueprint $table) {
            $table->string('agreement_no')->nullable();
            $table->dateTime('signed_date')->nullable();
            $table->string('sign_img')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('applicants', function (Blueprint $table) {
            $table->dropColumn('agreement_no');
            $table->dropColumn('signed_date');
            $table->dropColumn('sign_img');
        });
    }
}
