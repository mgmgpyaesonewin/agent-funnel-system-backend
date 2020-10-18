<?php

namespace Tests\Unit;

use App\BOPSession;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 * @coversNothing
 */
class BOPSessionTest extends TestCase
{
    /** @test */
    public function itHasATitle()
    {
        $session = BOPSession::create([
            'title' => 'Some Title',
        ]);

        $this->assertEquals('Some Title', $session->title);
    }
}
