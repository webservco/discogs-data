<?php

declare(strict_types=1);

namespace Tests\Unit\WebServCo\DiscogsData\Processors\Releases;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use WebServCo\DiscogsData\Data\Types;
use WebServCo\DiscogsData\Processors\Releases\AbstractProcessor;

final class AbstractProcessorTest extends TestCase
{
    #[Test]
    public function constantDataTypeHasExpectedValue(): void
    {
        $this->assertEquals(Types::RELEASE, AbstractProcessor::DATA_TYPE);
    }
}
