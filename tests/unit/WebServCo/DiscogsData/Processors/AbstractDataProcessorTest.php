<?php
namespace Tests\DiscogsData\Processors;

use PHPUnit\Framework\TestCase;
use WebServCo\DiscogsData\Processors\AbstractDataProcessor;

final class AbstractDataProcessorTest extends TestCase
{
    /**
     * @test
     */
    public function constantDataTypeHasExpectedValue()
    {
        $this->assertEquals(null, AbstractDataProcessor::DATA_TYPE);
    }
}
