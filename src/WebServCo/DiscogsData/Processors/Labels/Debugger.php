<?php
namespace WebServCo\DiscogsData\Processors\Labels;

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
        $id = $this->getDomElementId($domElement);
        return $this->saveXml($id, $domElement);
    }
}
