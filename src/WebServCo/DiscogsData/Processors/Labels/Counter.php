<?php

declare(strict_types=1);

namespace WebServCo\DiscogsData\Processors\Labels;

final class Counter extends AbstractProcessor implements
    \WebServCo\DiscogsData\Interfaces\DataProcessorInterface
{
    /*
    * Called by the parent method processItem
    * @param \DOMElement $domElement
    * @return bool
    */
    protected function processItemCustom(\DOMElement $domElement)
    {
        return true;
    }
}
