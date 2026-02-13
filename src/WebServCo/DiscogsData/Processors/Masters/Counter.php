<?php

declare(strict_types=1);

namespace WebServCo\DiscogsData\Processors\Masters;

use DOMElement;
use WebServCo\DiscogsData\Interfaces\DataProcessorInterface;

final class Counter extends AbstractProcessor implements
    DataProcessorInterface
{
    /*
    * Called by the parent method processItem
    */
    // phpcs:ignore SlevomatCodingStandard.Functions.UnusedParameter.UnusedParameter
    protected function processItemCustom(DOMElement $domElement): bool
    {
        return true;
    }
}
