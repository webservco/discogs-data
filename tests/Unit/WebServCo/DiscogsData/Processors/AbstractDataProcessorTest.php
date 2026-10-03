<?php

declare(strict_types=1);

namespace Tests\Unit\WebServCo\DiscogsData\Processors;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use WebServCo\DiscogsData\Processors\AbstractDataProcessor;

final class AbstractDataProcessorTest extends TestCase
{
    #[Test]
    public function constantDataTypeHasExpectedValue(): void
    {
        $this->assertEquals(null, AbstractDataProcessor::DATA_TYPE);
    }
}
