<?php
namespace WebServCo\DiscogsData;

use \WebServCo\DiscogsData\Exceptions\DataParserException;

final class DataParser
{
    protected $dataProcessor;
    protected $startCallable;
    protected $itemCallable;
    protected $finishCallable;
    protected $logger;
    protected $filePath;

    protected $xmlReader;
    protected $xmlNodeCount;
    protected $xmlItemCount;
    protected $xmlProcessedCount;

    public function __construct(
        \WebServCo\DiscogsData\Interfaces\DataProcessorInterface $dataProcessor,
        \WebServCo\Framework\Interfaces\LoggerInterface $logger,
        $filePath
    ) {
        if (!is_readable($filePath)) {
            throw new DataParserException(sprintf('File path not readable: %s', $filePath));
        }
        $this->filePath = $filePath;

        $this->initializeDataProcessor($dataProcessor);

        $this->logger = $logger;

        $this->xmlReader = new \XMLReader();
        if (!$this->xmlReader->open(sprintf('compress.zlib://%s', $this->filePath))) {
            throw new DataParserException(sprintf('Error opening file: %s', $filePath));
        }
        $this->xmlNodeCount = 0;
        $this->xmlItemCount = 0;
        $this->xmlProcessedCount = 0;
    }

    public function run()
    {
        $dataType = $this->dataProcessor->getDataType();
        call_user_func_array($this->startCallable, []);
        while ($this->xmlReader->read()) {
            ++ $this->xmlNodeCount;
            if (\XMLReader::ELEMENT == $this->xmlReader->nodeType && $dataType == $this->xmlReader->name) {
                ++ $this->xmlItemCount;
                $args = [$this->xmlReader->expand()];
                $result = call_user_func_array($this->itemCallable, $args);
                if ($result) {
                    ++ $this->xmlProcessedCount;
                }
                $this->xmlReader->next();
            }
            /* XXX *
            if (10000 == $this->xmlNodeCount) {
                break;
            }
            /* XXX */
        }
        $this->xmlReader->close();
        call_user_func_array($this->finishCallable, []);
        return;
    }

    protected function initializeDataProcessor($dataProcessor)
    {
        $this->dataProcessor = $dataProcessor;
        if (!is_callable([$this->dataProcessor, 'getDataType'])) {
            throw new DataParserException('Get data type method not found');
        }
        $this->startCallable = [$this->dataProcessor, 'start'];
        if (!is_callable($this->startCallable)) {
            throw new DataParserException('Start method not found');
        }
        $this->itemCallable = [$this->dataProcessor, 'processItem'];
        if (!is_callable($this->itemCallable)) {
            throw new DataParserException('Process item method not found');
        }
        $this->finishCallable = [$this->dataProcessor, 'finish'];
        if (!is_callable($this->finishCallable)) {
            throw new DataParserException('Finish method not found');
        }
    }
}
