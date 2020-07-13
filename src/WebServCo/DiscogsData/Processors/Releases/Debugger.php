<?php
namespace WebServCo\DiscogsData\Processors\Releases;

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
        /*$ids = [
            6721952, // Meat Loaf BOOH1
            6438424, // Avaricious MC
        ];
        if (in_array($id, $ids)) {*/
        return $this->saveXml($id, $domElement);
        /*}*/
    }
}
