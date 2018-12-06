<?php
namespace Tests\DiscogsData\Artists;

use PHPUnit\Framework\TestCase;
use WebServCo\DiscogsData\Artists\AbstractProcessor;

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
