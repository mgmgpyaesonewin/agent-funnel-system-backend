<?php

namespace Tests\Feature;

use App\Applicant;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
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
        $this->withoutExceptionHandling();

        $applicant = factory(Applicant::class)->create([
            'uuid' => (string) Str::uuid(),
        ]);

        Storage::fake('certificates');

        $response = $this->json('POST', '/api/certificate', [
            'uuid' => $applicant->uuid,
            'certificate' => $image = UploadedFile::fake()->image('certificate.jpg'),
        ]);

        $data = $response->getOriginalContent();

        $response->assertStatus(200);
        $this->assertEquals(true, $data['status']);
        $this->assertEquals('Successfully Created', $data['message']);
        // TODO:: FIXME storage is not working
        // Storage::disk('certificates')->assertExists($image->hashName());
    }
}
