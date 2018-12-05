<?php
namespace WebServCo\DiscogsData\Releases;

use WebServCo\Framework\Interfaces\OutputLoggerInterface;

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
