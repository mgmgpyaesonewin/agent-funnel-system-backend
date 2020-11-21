<?php

namespace Tests\Unit;

use App\Partner;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;

/**
 * @internal
 * @coversNothing
 */
/**
 * @internal
 * @coversNothing
 */
class PartnerTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function it_should_has_slug()

    {
        $company = $this->faker->company;
        $slug = Str::slug("{$company}", '');

        Partner::create([
            'company_name' => $company,
            'pic_name' => $this->faker->name,
            'pic_phone' => $this->faker->phoneNumber,
            'pic_email' => $this->faker->email,
        ]);

        $partner = Partner::first();

        $this->assertEquals($slug, $partner->slug);
    }
}
