<?php
namespace Tests\DiscogsData\Labels;

use PHPUnit\Framework\TestCase;
use WebServCo\DiscogsData\Labels\AbstractProcessor;

final class AbstractProcessorTest extends TestCase
{
    /**
     * @test
     */
    public function constantDataTypeHasExpectedValue()
    {
        $this->assertEquals(\WebServCo\DiscogsData\Data\Types::LABEL, AbstractProcessor::DATA_TYPE);
    }
}
