<?php

declare(strict_types=1);

namespace WebServCo\DiscogsData\Data;

use WebServCo\DiscogsData\Exceptions\DataParserException;
use WebServCo\DiscogsData\Interfaces\DataProcessorInterface;
use WebServCo\Framework\Cli\Runner\Statistics;
use WebServCo\Framework\Interfaces\CliRunnerInterface;
use WebServCo\Framework\Interfaces\LoggerInterface;
use XMLReader;

use function call_user_func_array;
use function is_callable;
use function is_readable;
use function round;
use function sprintf;
use function var_export;

final class Parser
{
    protected string $dataType;

    /**
    * Callable.
    *
    * @var array<\WebServCo\DiscogsData\Interfaces\DataProcessorInterface|string>
    */
    protected array $startCallable;

    /**
    * Callable.
    *
    * @var array<\WebServCo\DiscogsData\Interfaces\DataProcessorInterface|string>
    */
    protected array $itemCallable;

    /**
    * Callable.
    *
    * @var array<\WebServCo\DiscogsData\Interfaces\DataProcessorInterface|string>
    */
    protected array $finishCallable;

    protected XMLReader $xmlReader;

    protected int $xmlNodeCount;
    protected int $xmlItemCount;
    protected int $xmlProcessedCount;

    public function __construct(
        protected CliRunnerInterface $cliRunner,
        DataProcessorInterface $dataProcessor,
        protected LoggerInterface $logger,
        string $filePath,
    ) {
        if (!is_readable($filePath)) {
            throw new DataParserException(sprintf('File path not readable: %s', $filePath));
        }

        $this->dataType = $dataProcessor->getDataType();
        $this->setupCallables($dataProcessor);

        $this->xmlReader = new XMLReader();

        $this->xmlNodeCount = 0;
        $this->xmlItemCount = 0;
        $this->xmlProcessedCount = 0;

        // open compressed XML file
        if (!$this->xmlReader->open(sprintf('compress.zlib://%s', $filePath))) {
            throw new DataParserException(sprintf('Error opening file: %s', $filePath));
        }
    }

    public function run(): bool
    {
        // cli start
        $this->cliRunner->start();
        $this->logger->debug(__METHOD__);
        // cli pid
        $this->logger->debug(sprintf('pid: %s', $this->cliRunner->getPid()));

        if (!is_callable($this->startCallable)) {
            throw new DataParserException('Start method not found');
        }
        // dataProcessor->start
        call_user_func_array($this->startCallable, []);
        while ($this->xmlReader->read()) {
            // cli check
            if (!$this->cliRunner->isRunning()) {
                $this->logger->debug('Interrupt detected, stopping');

                break;
            }
            // phpcs:ignore SlevomatCodingStandard.Operators.DisallowIncrementAndDecrementOperators.DisallowedPreIncrementOperator
            ++$this->xmlNodeCount;
            if ($this->xmlReader->nodeType !== XMLReader::ELEMENT || $this->xmlReader->name !== $this->dataType) {
                continue;
            }

            // phpcs:ignore SlevomatCodingStandard.Operators.DisallowIncrementAndDecrementOperators.DisallowedPreIncrementOperator
            ++$this->xmlItemCount;
            $args = [$this->xmlReader->expand()];

            if (!is_callable($this->itemCallable)) {
                throw new DataParserException('Process item method not found');
            }
            // dataProcessor->processItem
            $result = call_user_func_array($this->itemCallable, $args);
            if ($result) {
                // phpcs:ignore SlevomatCodingStandard.Operators.DisallowIncrementAndDecrementOperators.DisallowedPreIncrementOperator
                ++$this->xmlProcessedCount;
            }
            $this->xmlReader->next();
        }
        $this->xmlReader->close();

        if (!is_callable($this->finishCallable)) {
            throw new DataParserException('Finish method not found');
        }
        // dataProcessor->finish
        call_user_func_array($this->finishCallable, []);

        // cli finish
        $this->cliRunner->finish();
        $statistics = $this->cliRunner->getStatistics();
        $this->debugStatistics($statistics);

        // cli result
        return $statistics->getResult();
    }

    protected function setupCallables(DataProcessorInterface $dataProcessor): void
    {
        $this->startCallable = [$dataProcessor, 'start'];
        if (!is_callable($this->startCallable)) {
            throw new DataParserException('Start method not found');
        }
        $this->itemCallable = [$dataProcessor, 'processItem'];
        if (!is_callable($this->itemCallable)) {
            throw new DataParserException('Process item method not found');
        }
        $this->finishCallable = [$dataProcessor, 'finish'];
        if (!is_callable($this->finishCallable)) {
            throw new DataParserException('Finish method not found');
        }
    }

    protected function debugStatistics(Statistics $statistics): void
    {
        $this->logger->debug(sprintf('Result: %s', var_export($statistics->getResult(), true)));
        $this->logger->debug(sprintf('Total items: %s', $this->xmlItemCount));
        $this->logger->debug(sprintf('Total processed: %s', $this->xmlProcessedCount));
        $duration = $statistics->getDuration();
        $this->logger->debug(sprintf('Running time: %s seconds', round($duration, 2)));
        $this->logger->debug(sprintf('Memory peak usage: %s K', $statistics->getMemoryPeakUsage()));
    }
}
