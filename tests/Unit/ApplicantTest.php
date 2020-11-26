<?php

namespace Tests\Unit;

use App\Applicant;
use App\Classes\Entity\BankEntity;
use App\Classes\Entity\ProducerEntity;
use App\Http\Controllers\ApplicantController;
use App\Setting;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
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

    /** @test */
    public function agent_effective_date()
    {
        factory(Applicant::class)->create()->each(function ($applicant) {
            $applicant->statuses()->attach(8, ['current_status' => 'active']);
        });

        $applicant = Applicant::find(1);
        $date = $applicant->getEffectiveDate();

        $expected_date = DB::table('applicant_status')
            ->where('status_id', 8)
            ->where('current_status', 'active')
            ->first()->created_at;

        $this->assertEquals($expected_date, $date);
    }

    /** @test */
    public function license_exam_pass_date()
    {
        factory(Applicant::class)->create()->each(function ($applicant) {
            $applicant->statuses()->attach(1, ['current_status' => 'onboard']);
        });

        $applicant = Applicant::find(1);
        $date = $applicant->getLicenseExamPassDate();

        $expected_date = DB::table('applicant_status')
            ->where('status_id', 1)
            ->where('current_status', 'onboard')
            ->first()->created_at;

        $this->assertEquals($expected_date, $date);
    }

    /** @test */
    public function has_spouse_should_return_false_if_single()
    {
        factory(Applicant::class)->create([
            'married' => 'Single',
            'spouse_name' => 'Pyae Sone'
        ]);

        $applicant = Applicant::find(1);

        $this->assertEquals(false, $applicant->hasSpouse());
    }

    /** @test */
    public function has_spouse_should_return_false_if_spouse_name_is_not_present()
    {
        factory(Applicant::class)->create([
            'married' => 'Married',
            'spouse_name' => null
        ]);

        $applicant = Applicant::find(1);

        $this->assertEquals(false, $applicant->hasSpouse());
    }

    /** @test */
    public function has_spouse_should_return_true_if_spouse_name_is_present_and_status_is_not_single()
    {
        factory(Applicant::class)->create([
            'married' => 'Divorced',
            'spouse_name' => 'Pyae Sone'
        ]);

        $applicant = Applicant::find(1);

        $this->assertEquals(true, $applicant->hasSpouse());
    }

    /** @test */
    public function get_current_company_name()
    {
        factory(Applicant::class)->create([
            'employment' => json_encode([
                [
                    'income' => null,
                    'address' => 'Yangon',
                    'position' => 'Sales',
                    'company_name' => 'GGI',
                    'industry_type' => 'Insurance',
                    'duration_to_date' => '2020-11-11',
                    'duration_from_date' => '2020-01-01'
                ],
                [
                    'income' => '100000000',
                    'address' => 'Sule Square',
                    'position' => 'Manager',
                    'company_name' => 'Company1',
                    'industry_type' => 'Service',
                    'duration_to_date' => '2020-11-04',
                    'duration_from_date' => '2017-01-01'
                ]
            ])
        ]);

        $applicant = Applicant::find(1);
        $company = $applicant->getPreviousCompanyData();

        $this->assertEquals('GGI', $company->company_name);
    }

    /** @test */
    public function get_state_code()
    {
        factory(Applicant::class)->create();

        $applicant = Applicant::find(1);
        $state_code = $applicant->getStateCode();

        $this->assertEquals('MM-YGN', $state_code);
    }

    /** @test */
    public function get_bank_name_short_code()
    {
        factory(Applicant::class)->create([
            'banK_name' => 'CO-OPERATIVE BANK (CB BANK)'
        ]);

        $applicant = Applicant::where('id', 1)->get();

        $bankEntity = new BankEntity($applicant);
        $bankEntity->setBankname($applicant->first());

        $this->assertSame('MM-CB', $bankEntity->getBankname());
    }

    /** @test */
    public function get_education_qualification()
    {
        factory(Applicant::class)->create([
            'education' => 'Primary Education'
        ]);
        $applicant = Applicant::where('id', 1)->get();

        $producerEntity = new ProducerEntity($applicant);
        $producerEntity->setEducationQualification($applicant->first());

        $this->assertSame('PR', $producerEntity->getEducationQualification());
    }
}
