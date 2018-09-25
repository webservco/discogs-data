<?php
namespace WebServCo\DiscogsData;

final class ReleasesProcessor extends AbstractProcessor implements \WebServCo\DiscogsData\Interfaces\ProcessorInterface
{
    public function processItem($xmlData)
    {
        print_r($xmlData); //XXX
        echo PHP_EOL; //XXX
        return; //XXX
    }
}
