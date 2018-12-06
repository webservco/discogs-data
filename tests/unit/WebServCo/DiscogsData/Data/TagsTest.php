<?php
namespace Tests\DiscogsData\Data;

use PHPUnit\Framework\TestCase;
use WebServCo\DiscogsData\Data\Tags;

final class TagsTest extends TestCase
{
    /**
     * @test
     */
    public function constantIdHasExpectedValue()
    {
        $this->assertEquals('id', Tags::ID);
    }
}
