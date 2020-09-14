<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSlugToPartnersTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('partners', function (Blueprint $table) {
            $table->string('slug')->after('pic_email');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('partners', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
    }
}
