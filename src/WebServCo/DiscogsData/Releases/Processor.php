<?php
namespace WebServCo\DiscogsData\Releases;

final class Processor extends AbstractProcessor implements
    \WebServCo\DiscogsData\Interfaces\DataProcessorInterface
{
    /*
    * Called by the parent method processItem
    * @param \DOMElement $domElement
    * @return bool
    */
    protected function processItemCustom(\DOMElement $domElement)
    {
        /* */
        var_dump($domElement->getAttribute('id')); //XXX
        var_dump($domElement->getAttribute('status')); //XXX
        var_dump($domElement); //XXX
        exit; //XXX
    }
}
