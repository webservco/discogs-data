<?php
namespace Tests\DiscogsData\Processors\Artists;

use PHPUnit\Framework\TestCase;
use WebServCo\DiscogsData\Processors\Artists\AbstractProcessor;

final class AbstractProcessorTest extends TestCase
{
    /**
     * @test
     */
    public function constantDataTypeHasExpectedValue()
    {
        $this->assertEquals(\WebServCo\DiscogsData\Data\Types::ARTIST, AbstractProcessor::DATA_TYPE);
    }
}
