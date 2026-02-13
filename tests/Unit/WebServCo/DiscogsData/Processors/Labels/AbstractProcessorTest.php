<?php

declare(strict_types=1);

namespace Tests\Unit\WebServCo\DiscogsData\Processors\Labels;

use PHPUnit\Framework\TestCase;
use WebServCo\DiscogsData\Processors\Labels\AbstractProcessor;

final class AbstractProcessorTest extends TestCase
{
    /**
     * @test
     */
    public function constantDataTypeHasExpectedValue(): void
    {
        $this->assertEquals(\WebServCo\DiscogsData\Data\Types::LABEL, AbstractProcessor::DATA_TYPE);
    }
}
