<?php
namespace Tests\DiscogsData\Processors\Masters;

use PHPUnit\Framework\TestCase;
use WebServCo\DiscogsData\Processors\Masters\AbstractProcessor;

final class AbstractProcessorTest extends TestCase
{
    /**
     * @test
     */
    public function constantDataTypeHasExpectedValue()
    {
        $this->assertEquals(\WebServCo\DiscogsData\Data\Types::MASTER, AbstractProcessor::DATA_TYPE);
    }
}
