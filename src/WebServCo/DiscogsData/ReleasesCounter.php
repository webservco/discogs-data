<?php
namespace WebServCo\DiscogsData;

final class ReleasesCounter extends AbstractDataProcessor implements
    \WebServCo\DiscogsData\Interfaces\DataProcessorInterface
{
    protected $progressLine;

    public function __construct()
    {
        parent::__construct();
        $this->progressLine = new \WebServCo\Framework\ProgressLine();
        $this->progressLine->setShowResult(false);
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

        $outputCheck = $this->totalItems%100;
        if (empty($outputCheck)) { // output every 100 items
            echo $this->progressLine->prefix(sprintf('Processing item %s', $this->totalItems));
        }
        echo $this->progressLine->suffix(); // pb suffix
    }

    public function finish()
    {
        echo $this->progressLine->finish();
        echo sprintf('Total items: %s%s', $this->totalItems, PHP_EOL);
    }
}
