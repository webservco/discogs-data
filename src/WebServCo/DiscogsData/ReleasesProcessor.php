<?php
namespace WebServCo\DiscogsData;

final class ReleasesProcessor extends AbstractDataProcessor implements
    \WebServCo\DiscogsData\Interfaces\DataProcessorInterface
{
    protected $totalItems = 0;

    public function getDataType()
    {
        return DataTypes::RELEASE;
    }

    public function processItem($data)
    {
        ++ $this->totalItems;

        $outputCheck = $this->totalItems%100;

        if (empty($outputCheck)) {
            echo sprintf('%s%s', $this->totalItems, PHP_EOL);
        }

        /* *
        var_dump($data->getAttribute('id')); //XXX
        var_dump($data->getAttribute('status')); //XXX
        //var_dump($data); //XXX
        echo PHP_EOL; //XXX
        exit; //XXX XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
        /* */
    }
}
