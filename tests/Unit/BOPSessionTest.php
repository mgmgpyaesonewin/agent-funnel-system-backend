<?php

namespace Tests\Unit;

use App\BOPSession;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @internal
 * @coversNothing
 */
class BOPSessionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function itHasTitleSessionDateTimeURL()
    {
        $dateTime = now();

        $session = BOPSession::create([
            'title' => 'Some Title',
            'session' => $dateTime,
            'url' => 'Some URL',
        ]);

        $this->assertEquals('Some Title', $session->title);
        $this->assertEquals($dateTime, $session->session);
        $this->assertEquals('Some URL', $session->url);
    }
}
