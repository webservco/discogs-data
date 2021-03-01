<?php

declare(strict_types=1);

namespace WebServCo\DiscogsData\Data;

use WebServCo\DiscogsData\Exceptions\DataParserException;
use WebServCo\DiscogsData\Interfaces\DataProcessorInterface;
use WebServCo\Framework\Interfaces\CliRunnerInterface;
use WebServCo\Framework\Interfaces\LoggerInterface;

final class Parser
{
    protected CliRunnerInterface $cliRunner;

    protected LoggerInterface $logger;

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

    protected \XMLReader $xmlReader;

    protected int $xmlNodeCount;
    protected int $xmlItemCount;
    protected int $xmlProcessedCount;

    public function __construct(
        CliRunnerInterface $cliRunner,
        DataProcessorInterface $dataProcessor,
        LoggerInterface $logger,
        string $filePath
    ) {
        if (!\is_readable($filePath)) {
            throw new DataParserException(\sprintf('File path not readable: %s', $filePath));
        }
        $this->cliRunner = $cliRunner;
        $this->logger = $logger;

        $this->dataType = $dataProcessor->getDataType();
        $this->setupCallables($dataProcessor);

        $this->xmlReader = new \XMLReader();

        $this->xmlNodeCount = 0;
        $this->xmlItemCount = 0;
        $this->xmlProcessedCount = 0;

        // open compressed XML file
        if (!$this->xmlReader->open(\sprintf('compress.zlib://%s', $filePath))) {
            throw new DataParserException(\sprintf('Error opening file: %s', $filePath));
        }
    }

    public function run(): bool
    {
        $this->cliRunner->start(); // cli start
        $this->logger->debug(__METHOD__);
        $this->logger->debug(\sprintf('pid: %s', $this->cliRunner->getPid())); // cli pid

        \call_user_func_array($this->startCallable, []); // dataProcessor->start
        while ($this->xmlReader->read()) {
            if (!$this->cliRunner->isRunning()) { // cli check
                $this->logger->debug('Interrupt detected, stopping');
                break;
            }
            // phpcs:ignore SlevomatCodingStandard.Operators.DisallowIncrementAndDecrementOperators.DisallowedPreIncrementOperator
            ++$this->xmlNodeCount;
            if (\XMLReader::ELEMENT !== $this->xmlReader->nodeType || $this->xmlReader->name !== $this->dataType) {
                continue;
            }

            // phpcs:ignore SlevomatCodingStandard.Operators.DisallowIncrementAndDecrementOperators.DisallowedPreIncrementOperator
            ++$this->xmlItemCount;
            $args = [$this->xmlReader->expand()];
            $result = \call_user_func_array($this->itemCallable, $args); // dataProcessor->processItem
            if ($result) {
                // phpcs:ignore SlevomatCodingStandard.Operators.DisallowIncrementAndDecrementOperators.DisallowedPreIncrementOperator
                ++$this->xmlProcessedCount;
            }
            $this->xmlReader->next();
        }
        $this->xmlReader->close();
        \call_user_func_array($this->finishCallable, []); // dataProcessor->finish

        $this->cliRunner->finish(); // cli finish
        $statistics = $this->cliRunner->getStatistics();
        $this->debugStatistics($statistics);
        return $statistics->getResult(); // cli result
    }

    protected function setupCallables(DataProcessorInterface $dataProcessor): void
    {
        $this->startCallable = [$dataProcessor, 'start'];
        if (!\is_callable($this->startCallable)) {
            throw new DataParserException('Start method not found');
        }
        $this->itemCallable = [$dataProcessor, 'processItem'];
        if (!\is_callable($this->itemCallable)) {
            throw new DataParserException('Process item method not found');
        }
        $this->finishCallable = [$dataProcessor, 'finish'];
        if (!\is_callable($this->finishCallable)) {
            throw new DataParserException('Finish method not found');
        }
    }

    protected function debugStatistics(\WebServCo\Framework\Cli\Runner\Statistics $statistics): void
    {
        $this->logger->debug(\sprintf('Result: %s', \var_export($statistics->getResult(), true)));
        $this->logger->debug(\sprintf('Total items: %s', $this->xmlItemCount));
        $this->logger->debug(\sprintf('Total processed: %s', $this->xmlProcessedCount));
        $duration = $statistics->getDuration();
        $this->logger->debug(\sprintf('Running time: %s seconds', \round($duration, 2)));
        $this->logger->debug(\sprintf('Memory peak usage: %s K', $statistics->getMemoryPeakUsage()));
    }
}
