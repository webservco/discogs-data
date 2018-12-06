<?php
namespace Tests\DiscogsData\Data;

use PHPUnit\Framework\TestCase;
use WebServCo\DiscogsData\Data\Types;

final class TypesTest extends TestCase
{
    /**
     * @test
     */
    public function constantArtistHasExpectedValue()
    {
        $this->assertEquals('artist', Types::ARTIST);
    }

    /**
     * @test
     */
    public function constantLabelHasExpectedValue()
    {
        $this->assertEquals('label', Types::LABEL);
    }

    /**
     * @test
     */
    public function constantMasterHasExpectedValue()
    {
        $this->assertEquals('master', Types::MASTER);
    }

    /**
     * @test
     */
    public function constantReleaseHasExpectedValue()
    {
        $this->assertEquals('release', Types::RELEASE);
    }
}
