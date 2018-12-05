<?php
namespace WebServCo\DiscogsData;

use WebServCo\Framework\Interfaces\OutputLoggerInterface;

final class ReleasesCounter extends AbstractReleasesProcessor implements
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
