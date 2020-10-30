<?php

namespace Tests\Unit;

use App\Applicant;
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
}
