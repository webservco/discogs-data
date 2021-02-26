<?php

declare(strict_types=1);

namespace Tests\DiscogsData\Data;

use PHPUnit\Framework\TestCase;
use WebServCo\DiscogsData\Data\Attributes;

final class AttributesTest extends TestCase
{
    /**
     * @test
     */
    public function constantIdHasExpectedValue(): void
    {
        $this->assertEquals('id', Attributes::ID);
    }
}
