<?php
namespace Tests\DiscogsData\Releases;

use PHPUnit\Framework\TestCase;
use WebServCo\DiscogsData\Releases\AbstractProcessor;

final class AbstractProcessorTest extends TestCase
{
    /**
     * @test
     */
    public function constantDataTypeHasExpectedValue()
    {
        $this->assertEquals(\WebServCo\DiscogsData\Data\Types::RELEASE, AbstractProcessor::DATA_TYPE);
    }
}
