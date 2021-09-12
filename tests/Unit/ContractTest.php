<?php

namespace Tests\Unit;

use App\Models\Applicant;
use App\Models\Contract;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ContractTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function contract_have_agreement_number(): void
    {
        $applicant = Applicant::factory()->create([
            'current_status' => 'active',
            'status_id' => 8
        ]);

        $original_contract = Contract::factory()->create([
            'applicant_id' => $applicant->id
        ]);

        $contract = Contract::find(1);
        $this->assertEquals($original_contract->version, $contract->version);
        $this->assertEquals('00001', $contract->agreement_no);
    }
}
