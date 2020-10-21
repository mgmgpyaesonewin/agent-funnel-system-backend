<?php

namespace Tests\Unit;

use App\BopSession;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @internal
 * @coversNothing
 */
class BopSessionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function itHasTitleSessionDateTimeURL()
    {
        $dateTime = now();

        $session = BopSession::create([
            'title' => 'Some Title',
            'session' => $dateTime,
            'url' => 'Some URL',
        ]);

        $this->assertEquals('Some Title', $session->title);
        $this->assertEquals($dateTime, $session->session);
        $this->assertEquals('Some URL', $session->url);
    }
}
