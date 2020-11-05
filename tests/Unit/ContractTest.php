<?php

namespace Tests\Unit;

use App\Applicant;
use App\Contract;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ContractTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function contract_have_agreement_number()
    {
        $applicant = factory(Applicant::class)->create([
            'current_status' => 'active',
            'status_id' => 8
        ]);

        $original_contract = factory(Contract::class)->create([
            'applicant_id' => $applicant->id
        ]);

        $contract = Contract::find(1);
        $this->assertEquals($original_contract->version, $contract->version);
        $this->assertEquals('Version 1', $contract->agreement_no);
    }
}
