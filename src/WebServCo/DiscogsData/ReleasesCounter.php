<?php
namespace WebServCo\DiscogsData;

final class ReleasesCounter extends AbstractReleasesProcessor implements
    \WebServCo\DiscogsData\Interfaces\DataProcessorInterface
{
    protected $progressLine;
    protected $timeStart;
    protected $timeFinish;

    public function __construct(\WebServCo\Framework\Interfaces\LoggerInterface $logger)
    {
        parent::__construct($logger);
        $this->progressLine = new \WebServCo\Framework\ProgressLine();
        $this->progressLine->setShowResult(false);
    }

    public function start()
    {
        $this->timeStart = $this->createCurrentTimeObject();
        $this->logger->debug(__CLASS__ . PHP_EOL);
    }

    public function processItem($data)
    {
        ++ $this->totalItems;

        $outputCheck = $this->totalItems%100;
        if (empty($outputCheck)) { // output every 100 items
            $this->logger->debug(
                $this->progressLine->prefix(sprintf('Processing item %s', $this->totalItems))
            );
        }
        $this->logger->debug($this->progressLine->suffix()); // pb suffix
    }

    public function finish()
    {
        $this->timeFinish = $this->createCurrentTimeObject();
        $this->logger->debug($this->progressLine->finish());
        $this->showStats();
    }

    protected function showStats()
    {
        $this->logger->debug(sprintf('Total items: %s%s', $this->totalItems, PHP_EOL));
        $this->logger->debug(
            sprintf(
                'Running time: %s seconds (from %s to %s)%s',
                round($this->timeFinish->format("U.u") - $this->timeStart->format("U.u"), 3),
                $this->timeStart->format("Y-m-d H:i:s"),
                $this->timeFinish->format("Y-m-d H:i:s"),
                PHP_EOL
            )
        );
        $this->logger->debug(
            sprintf(
                'Memory peak usage: %s K%s',
                memory_get_peak_usage(true) / 1024,
                PHP_EOL
            )
        );
    }

    protected function createCurrentTimeObject()
    {
        $dateTime = \DateTime::createFromFormat('U.u', (string) microtime(true));
        if (!($dateTime instanceof \DateTime)) {
            throw new \WebServCo\DiscogsData\Exceptions\DataProcessorException(
                'Error initializing DateTime object'
            );
        }
        $dateTime->setTimezone(new \DateTimeZone('Europe/Budapest'));
        return $dateTime;
    }
}
