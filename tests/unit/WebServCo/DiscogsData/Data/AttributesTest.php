<?php
namespace Tests\DiscogsData\Data;

use PHPUnit\Framework\TestCase;
use WebServCo\DiscogsData\Data\Attributes;

final class AttributesTest extends TestCase
{
    /**
     * @test
     */
    public function constantIdHasExpectedValue()
    {
        $this->assertEquals('id', Attributes::ID);
    }
}
