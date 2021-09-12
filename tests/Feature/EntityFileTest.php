<?php

namespace Tests\Feature;

use App\Models\Applicant;
use App\Models\Contract;
use App\Models\User;
use App\Classes\Entity\AdditionalInformationEntity;
use App\Classes\Entity\BankEntity;
use App\Classes\Entity\ContactEntity;
use App\Classes\Entity\ContractEntity;
use App\Classes\Entity\ProducerEntity;
use App\Http\Controllers\ApplicantController;
use App\Jobs\GenerateEducationEntity;
use App\Jobs\GenerateLicenseEntity;
use App\Jobs\GenerateRelatedPersonEntity;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class EntityFileTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    protected $admin;
    protected $applicants;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutExceptionHandling();

        $this->admin = User::factory()->create([
            'is_admin' => 1,
            'is_bdm' => 0,
            'is_ma' => 0,
            'is_staff' => 0,
        ]);

        $admin = $this->admin;

        $this->applicants = Applicant::factory()->count(25)->create()->each(function (Applicant $applicant, $index) use ($admin) {
            $applicantController = new ApplicantController();
            $applicant->agent_code = $applicantController->generateAgentCode($index);
            $applicant->temp_id = 'FA'.str_pad($applicant->id, 6, '0', STR_PAD_LEFT);
            Contract::factory()->create([
                'applicant_id' => $applicant->id
            ]);
            $applicant->save();
            $applicant->statuses()->attach(1, [
                'current_status' => 'onboard',
                'user_id' => $admin->id,
                'created_at' => Carbon::now()->subDays(3)
            ]);
            $applicant->statuses()->attach(8, [
                'current_status' => 'active',
                'user_id' => $admin->id,
            ]);
        });
    }

    /** @test */
    public function generate_producer_entity_file()
    {
        $producerEntity = new ProducerEntity($this->applicants);
        $producerEntity->generateFileName('PROD');

        $file = $producerEntity->getFilename();
        $producerEntity->generateFile();

        Storage::disk('public')->assertExists("agents/{$file}");
    }

    /** @test */
    public function generate_producer_additional_entity_file()
    {
        $producerAdditionalEntity = new AdditionalInformationEntity($this->applicants);
        $producerAdditionalEntity->generateFileName('ADD_INFO');

        $file = $producerAdditionalEntity->getFilename();
        $producerAdditionalEntity->generateFile();

        Storage::disk('public')->assertExists("agents/{$file}");
    }

    /** @test */
    public function generate_contact_entity_file()
    {
        $producerAdditionalEntity = new ContactEntity($this->applicants);
        $producerAdditionalEntity->generateFileName('CONT');

        $file = $producerAdditionalEntity->getFilename();
        $producerAdditionalEntity->generateFile();

        Storage::disk('public')->assertExists("agents/{$file}");
    }

    /** @test */
    public function generate_contract_entity_file()
    {
        $contractEntity = new ContractEntity($this->applicants);
        $contractEntity->generateFileName('CONTR');

        $file = $contractEntity->getFilename();
        $contractEntity->generateFile();

        Storage::disk('public')->assertExists("agents/{$file}");
    }

    public function generate_related_person_entity_file()
    {
        $relatedPersonEntity = new GenerateRelatedPersonEntity();
        $relatedPersonEntity->handle();
    }

    public function generate_education_entity_file()
    {
        $educationEntity = new GenerateEducationEntity();
        $educationEntity->handle();
    }

    /** @test */
    public function generate_paybank_entity_file()
    {
        $bankEntity = new BankEntity($this->applicants);
        $bankEntity->generateFileName('BANK');

        $file = $bankEntity->getFilename();
        $bankEntity->generateFile();

        Storage::disk('public')->assertExists("agents/{$file}");
    }

    public function generate_license_entity_file()
    {
        $bankEntity = new GenerateLicenseEntity();
        $bankEntity->handle();
    }
}
