<?php
namespace WebServCo\DiscogsData;

final class ReleasesProcessor extends AbstractReleasesProcessor implements
    \WebServCo\DiscogsData\Interfaces\DataProcessorInterface
{
    /*
    * @param mixed $data
    * @return bool
    */
    public function processItem(\DOMElement $domElement)
    {
        parent::processItem($domElement); // increments counter
        /* */
        //var_dump($data->getAttribute('id')); //XXX
        //var_dump($data->getAttribute('status')); //XXX
        //var_dump($data); //XXX

        $outputCheck = $this->totalItems%1000;
        if (empty($outputCheck)) { // output every 1000 items
            $this->logger->debug(
                $this->progressLine->prefix(sprintf('Processing item %s', $this->totalItems)) // pl prefix
            );
        }
        $result = $this->saveXml($domElement); // save XML for each item
        if (empty($outputCheck)) { // output every 1000 items
            $this->logger->debug($this->progressLine->suffix($result)); // pl suffix
        }
        return $result;
    }
}
