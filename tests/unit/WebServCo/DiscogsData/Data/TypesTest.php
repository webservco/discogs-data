<?php

declare(strict_types=1);

namespace Tests\DiscogsData\Data;

use PHPUnit\Framework\TestCase;
use WebServCo\DiscogsData\Data\Types;

final class TypesTest extends TestCase
{
    /**
     * @test
     */
    public function constantArtistHasExpectedValue(): void
    {
        $this->assertEquals('artist', Types::ARTIST);
    }

    /**
     * @test
     */
    public function constantLabelHasExpectedValue(): void
    {
        $this->assertEquals('label', Types::LABEL);
    }

    /**
     * @test
     */
    public function constantMasterHasExpectedValue(): void
    {
        $this->assertEquals('master', Types::MASTER);
    }

    /**
     * @test
     */
    public function constantReleaseHasExpectedValue(): void
    {
        $this->assertEquals('release', Types::RELEASE);
    }
}
