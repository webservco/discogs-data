<?php
namespace WebServCo\DiscogsData;

final class ReleasesCounter extends AbstractReleasesProcessor implements
    \WebServCo\DiscogsData\Interfaces\DataProcessorInterface
{
    /*
    * @param \DOMElement $domElement
    * @return bool
    */
    public function processItem(\DOMElement $domElement)
    {
        parent::processItem($domElement); // increments counter

        $outputCheck = $this->totalItems%1000;
        if (empty($outputCheck)) { // output every 1000 items
            $this->logger->debug(
                $this->progressLine->prefix(sprintf('Processing item %s', $this->totalItems)) // pl prefix
            );
        }
        $result = true;
        if (empty($outputCheck)) { // output every 1000 items
            $this->logger->debug($this->progressLine->suffix()); // pl suffix
        }
        return $result;
    }
}
