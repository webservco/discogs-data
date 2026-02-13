<?php

declare(strict_types=1);

namespace Tests\Unit\WebServCo\DiscogsData\Processors\Masters;

use PHPUnit\Framework\TestCase;
use WebServCo\DiscogsData\Data\Types;
use WebServCo\DiscogsData\Processors\Masters\AbstractProcessor;

final class AbstractProcessorTest extends TestCase
{
    /**
     * @test
     */
    public function constantDataTypeHasExpectedValue(): void
    {
        $this->assertEquals(Types::MASTER, AbstractProcessor::DATA_TYPE);
    }
}
