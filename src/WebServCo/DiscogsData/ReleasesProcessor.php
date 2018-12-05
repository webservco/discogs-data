<?php
namespace WebServCo\DiscogsData;

final class ReleasesProcessor extends AbstractReleasesProcessor implements
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
        //var_dump($data->getAttribute('id')); //XXX
        //var_dump($data->getAttribute('status')); //XXX
        //var_dump($data); //XXX
        return $this->saveXml($domElement); // save XML for each item
    }
}
