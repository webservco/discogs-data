<?php

declare(strict_types=1);

namespace Tests\Unit\WebServCo\DiscogsData\Data;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use WebServCo\DiscogsData\Data\Types;

final class TypesTest extends TestCase
{
    #[Test]
    public function constantArtistHasExpectedValue(): void
    {
        $this->assertEquals('artist', Types::ARTIST);
    }

    #[Test]
    public function constantLabelHasExpectedValue(): void
    {
        $this->assertEquals('label', Types::LABEL);
    }

    #[Test]
    public function constantMasterHasExpectedValue(): void
    {
        $this->assertEquals('master', Types::MASTER);
    }

    #[Test]
    public function constantReleaseHasExpectedValue(): void
    {
        $this->assertEquals('release', Types::RELEASE);
    }
}
