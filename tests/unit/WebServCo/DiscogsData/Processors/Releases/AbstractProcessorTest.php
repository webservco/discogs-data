<?php

declare(strict_types=1);

namespace Tests\DiscogsData\Processors\Releases;

use PHPUnit\Framework\TestCase;
use WebServCo\DiscogsData\Processors\Releases\AbstractProcessor;

final class AbstractProcessorTest extends TestCase
{
    /**
     * @test
     */
    public function constantDataTypeHasExpectedValue(): void
    {
        $this->assertEquals(\WebServCo\DiscogsData\Data\Types::RELEASE, AbstractProcessor::DATA_TYPE);
    }
}
