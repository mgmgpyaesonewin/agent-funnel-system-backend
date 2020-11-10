<?php

namespace Tests\Unit;

use App\Applicant;
use App\Http\Controllers\ApplicantController;
use App\Setting;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ApplicantTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_has_optional_bank_branch_name()
    {
        factory(Applicant::class)->create([
            'bank_branch_name' => 'SanChaung'
        ]);

        factory(Applicant::class)->create();

        $applicant = Applicant::find(1);
        $applicant_2 = Applicant::find(2);

        $this->assertEquals('SanChaung', $applicant->bank_branch_name);
        $this->assertNull($applicant_2->bank_branch_name);
    }

    /** @test */
    public function generate_agent_code_via_sequence_from_setting()
    {
        factory(Setting::class)->create([
            'meta_key' => 'agent_code_current_id',
            'meta_value' => 0
        ]);

        $applicantController = new ApplicantController();
        $current_agent_code_id = $applicantController->getAgentCodeCurrentID();
        $agent_code = $applicantController->generateAgentCode($current_agent_code_id);

        $this->assertEquals('02200001', $agent_code);

        $applicantController->updateAgentCode();
        $current_agent_code_id = $applicantController->getAgentCodeCurrentID();

        $this->assertEquals(1, $current_agent_code_id);
    }
}
