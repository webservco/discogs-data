<?php
namespace Tests\DiscogsData;

use PHPUnit\Framework\TestCase;
use WebServCo\DiscogsData\AbstractDataProcessor;

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
