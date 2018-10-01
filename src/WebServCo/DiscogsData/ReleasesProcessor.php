<?php
namespace WebServCo\DiscogsData;

final class ReleasesProcessor extends AbstractDataProcessor implements
    \WebServCo\DiscogsData\Interfaces\DataProcessorInterface
{
    protected $progressLine;

    public function __construct()
    {
        parent::__construct();
        //$this->progressLine = new \WebServCo\Framework\ProgressLine();
        //$this->progressLine->setShowResult(false);
    }

    public function getDataType()
    {
        return DataTypes::RELEASE;
    }

    public function start()
    {
        echo __CLASS__ . PHP_EOL;
    }

    public function processItem($data)
    {
        ++ $this->totalItems;

        /*
        $this->progressLine->advanceTo($this->totalItems); // pb advance
        $outputCheck = $this->totalItems%100;
        if (empty($outputCheck)) {
            echo $this->progressLine->prefix(sprintf('Processing %s', $this->totalItems));
        }
        echo $this->progressLine->suffix(); // pb suffix
        */

        /* */
        var_dump($data->getAttribute('id')); //XXX
        var_dump($data->getAttribute('status')); //XXX
        //var_dump($data); //XXX
        echo PHP_EOL; //XXX
        exit; //XXX XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
        /* */
    }

    public function finish()
    {
        //echo $this->progressLine->finish();
        echo sprintf('Total items: %s%s', $this->totalItems, PHP_EOL);
    }
}
