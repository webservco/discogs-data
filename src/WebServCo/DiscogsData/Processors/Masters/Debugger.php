<?php
namespace WebServCo\DiscogsData\Processors\Masters;

final class Debugger extends AbstractProcessor implements
    \WebServCo\DiscogsData\Interfaces\DataProcessorInterface
{
    /*
    * Called by the parent method processItem
    * @param \DOMElement $domElement
    * @return bool
    */
    protected function processItemCustom(\DOMElement $domElement)
    {
        return $this->saveXml($domElement); // save XML for each item
    }
}
