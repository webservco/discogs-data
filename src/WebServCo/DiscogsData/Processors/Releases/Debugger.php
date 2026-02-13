<?php

declare(strict_types=1);

namespace WebServCo\DiscogsData\Processors\Releases;

use DOMElement;
use WebServCo\DiscogsData\Interfaces\DataProcessorInterface;

final class Debugger extends AbstractProcessor implements
    DataProcessorInterface
{
    /*
    * Called by the parent method processItem
    */
    protected function processItemCustom(DOMElement $domElement): bool
    {
        $id = $this->getDomElementId($domElement);

        return $this->saveXml($id, $domElement);
    }
}
