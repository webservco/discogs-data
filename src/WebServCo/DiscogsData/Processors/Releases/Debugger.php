<?php

declare(strict_types=1);

namespace WebServCo\DiscogsData\Processors\Releases;

final class Debugger extends AbstractProcessor implements
    \WebServCo\DiscogsData\Interfaces\DataProcessorInterface
{
    /*
    * Called by the parent method processItem
    */
    protected function processItemCustom(\DOMElement $domElement): bool
    {
        $id = $this->getDomElementId($domElement);
        return $this->saveXml($id, $domElement);
    }
}
