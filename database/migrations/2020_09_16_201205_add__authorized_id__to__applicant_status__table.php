<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAuthorizedIdToApplicantStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('applicant_status', function (Blueprint $table) {
            $table->bigInteger('user_id')->unsigned()->nullable()->after('current_status');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('applicant_status', function (Blueprint $table) {
            $table->dropColumn('authorized_id');
        });  
    }
}
