<?php

declare(strict_types=1);

namespace Tests\Unit\WebServCo\DiscogsData\Processors\Labels;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use WebServCo\DiscogsData\Data\Types;
use WebServCo\DiscogsData\Processors\Labels\AbstractProcessor;

final class AbstractProcessorTest extends TestCase
{
    #[Test]
    public function constantDataTypeHasExpectedValue(): void
    {
        $this->assertEquals(Types::LABEL, AbstractProcessor::DATA_TYPE);
    }
}
