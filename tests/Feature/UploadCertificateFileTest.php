<?php

namespace Tests\Feature;

use App\Applicant;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

/**
 * @internal
 * @coversNothing
 */
class UploadCertificateFileTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function aCertificateCanBeUploaded()
    {
        $applicant = factory(Applicant::class)->make();
        Storage::fake('certificates');

        $this->json('POST', '/api/certificate', [
            'uuid' => 'some_uuid_here',
            'certificate' => UploadedFile::fake()->image('certificate.jpg'),
        ]);

        Storage::disk('certificates')->assertExists('certificate.jpg');
    }
}


