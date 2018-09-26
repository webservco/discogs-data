<?php
namespace WebServCo\DiscogsData;

final class ReleasesProcessor extends AbstractDataProcessor implements
    \WebServCo\DiscogsData\Interfaces\DataProcessorInterface
{
    public function processItem($xmlData)
    {
        print_r($xmlData); //XXX
        echo PHP_EOL; //XXX
        return; //XXX
    }
}
