<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBankInfoApplicant extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('applicants', function (Blueprint $table) {
            $table->string('bank_account_no');
            $table->string('bank_account_name');
            $table->string('banK_name');
            $table->string('license_no');
            $table->string('license_photo_1');
            $table->string('license_photo_2');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('applicants', function (Blueprint $table) {
            $table->dropColumn('bank_account_no');
            $table->dropColumn('bank_account_name');
            $table->dropColumn('banK_name');
            $table->dropColumn('license_no');
            $table->dropColumn('license_photo_1');
            $table->dropColumn('license_photo_2');
        });
    }
}
