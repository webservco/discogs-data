<?php
namespace WebServCo\DiscogsData;

final class ReleasesProcessor extends AbstractDataProcessor implements
    \WebServCo\DiscogsData\Interfaces\DataProcessorInterface
{
    protected $progressBar;

    public function __construct()
    {
        parent::__construct();
        $this->progressBar = new \WebServCo\Framework\ProgressBar(20); //size
        $this->progressBar->setType('single_line'); //single_line, multi_line
        $this->progressBar->start(100000); // pb start
    }

    public function getDataType()
    {
        return DataTypes::RELEASE;
    }

    public function start()
    {
        echo __METHOD__ . PHP_EOL;
    }

    public function processItem($data)
    {
        ++ $this->totalItems;

        $this->progressBar->advanceTo($this->totalItems); // pb advance
        echo $this->progressBar->prefix(sprintf('Processing %s/%s', $this->totalItems, 100000));

        $outputCheck = $this->totalItems%100;

        //if (empty($outputCheck)) {
            //echo sprintf('%s%s', $this->totalItems, PHP_EOL);
        //}
        $result = true;
        echo $this->progressBar->suffix($result); // pb suffix

        /* *
        var_dump($data->getAttribute('id')); //XXX
        var_dump($data->getAttribute('status')); //XXX
        //var_dump($data); //XXX
        echo PHP_EOL; //XXX
        exit; //XXX XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
        /* */
    }

    public function finish()
    {
        echo PHP_EOL;
    }
}
