<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColsToPromoCodeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('promo_codes', function (Blueprint $table) {
            $table->date('from')->nullable();
            $table->date('to')->nullable(); 
            $table->string('type',20);
            $table->string('value',20);            
            $table->string('service_type_id', 20)->nullable();
            $table->string('category_id', 20)->nullable();
            $table->enum('status', ['active', 'paused', 'finished'])->default('active');
            $table->string('remark')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('promo_codes', function (Blueprint $table) {
            //
        });
    }
}
