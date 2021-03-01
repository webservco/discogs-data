<?php

declare(strict_types=1);

namespace WebServCo\DiscogsData\Processors\Releases;

final class Counter extends AbstractProcessor implements
    \WebServCo\DiscogsData\Interfaces\DataProcessorInterface
{
    /*
    * Called by the parent method processItem
    */
    // phpcs:ignore SlevomatCodingStandard.Functions.UnusedParameter.UnusedParameter
    protected function processItemCustom(\DOMElement $domElement): bool
    {
        return true;
    }
}
