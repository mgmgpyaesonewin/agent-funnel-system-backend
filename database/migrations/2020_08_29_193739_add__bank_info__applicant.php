<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBankInfoApplicant extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('applicants', function (Blueprint $table) {
            $table->string('bank_account_no', 20)->nullable();
            $table->string('bank_account_name')->nullable();
            $table->string('banK_name')->nullable();
            $table->string('license_no')->nullable();
            $table->string('license_photo_1')->nullable();
            $table->string('pdf')->nullable();
            $table->uuid('uuid');
            $table->string('license_photo_2')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('applicants', function (Blueprint $table) {
            $table->dropColumn('bank_account_no');
            $table->dropColumn('bank_account_name');
            $table->dropColumn('banK_name');
            $table->dropColumn('license_no');
            $table->dropColumn('license_photo_1');
            $table->dropColumn('pdf');
            $table->dropColumn('uuid');
            $table->dropColumn('license_photo_2');
        });
    }
}
