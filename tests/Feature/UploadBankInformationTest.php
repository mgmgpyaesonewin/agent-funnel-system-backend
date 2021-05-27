<?php

namespace Tests\Feature;

use App\Applicant;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class UploadBankInformationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function applicant_can_upload_bank_info_with_license_info()
    {
        $this->withoutExceptionHandling();

        $applicant = factory(Applicant::class)->create();

        $response = $this->post("/api/bank_update/{$applicant->id}", [
            'name' => $applicant->name,
            'account_no' => '012345678912',
            'bank_name' => json_encode([
                'name' => 'CO-OPERATIVE BANK (CB BANK)',
                'code' => 'CPOBMMMY'
            ]),
            'bank_branch_name' => 'SanChaung',
            'license_number' => '12245678',
            'license_photo' => UploadedFile::fake()->image('license_1.jpg'),
        ]);

        $data = $response->getOriginalContent();

        $response->assertStatus(200);
        $this->assertEquals($applicant->name, $data->bank_account_name);
        $this->assertEquals('012345678912', $data->bank_account_no);
        $this->assertEquals('CO-OPERATIVE BANK (CB BANK)', $data->bank_name);
        $this->assertEquals('CPOBMMMY', $data->swift_code);
        $this->assertEquals('SanChaung', $data->bank_branch_name);
        $this->assertEquals('12245678', $data->license_no);
    }
}
