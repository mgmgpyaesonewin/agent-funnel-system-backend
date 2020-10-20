<?php

use Illuminate\Database\Migrations\Migration;

class AlterApplicantsCurrentStatusColumn extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        DB::statement("ALTER TABLE applicants CHANGE COLUMN current_status current_status ENUM ('pre_filter', 'bop_session', 'pru_dna_test', 'pmli_filter', 'training', 'certification', 'onboard', 'active', 'lead', 'waiting_payment') NOT NULL DEFAULT 'pre_filter'");
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        DB::statement("ALTER TABLE applicants CHANGE COLUMN current_status current_status ENUM ('pre_filter', 'pru_dna_test', 'pmli_filter', 'training', 'certification', 'onboard', 'active', 'lead', 'waiting_payment') NOT NULL DEFAULT 'pre_filter'");
    }
}
