<?php

declare(strict_types=1);

namespace Tests\Unit\WebServCo\DiscogsData\Processors\Artists;

use PHPUnit\Framework\TestCase;
use WebServCo\DiscogsData\Data\Types;
use WebServCo\DiscogsData\Processors\Artists\AbstractProcessor;

final class AbstractProcessorTest extends TestCase
{
    /**
     * @test
     */
    public function constantDataTypeHasExpectedValue(): void
    {
        $this->assertEquals(Types::ARTIST, AbstractProcessor::DATA_TYPE);
    }
}
