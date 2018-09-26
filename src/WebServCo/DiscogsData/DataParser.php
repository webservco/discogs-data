<?php
namespace WebServCo\DiscogsData;

use \WebServCo\DiscogsData\Exceptions\DataParserException;

final class DataParser
{
    protected $dataProcessor;
    protected $logger;
    protected $filePath;

    protected $xmlReader;
    protected $xmlNodeCount = 0;
    protected $xmlItemCount = 0;
    protected $xmlProcessedCount = 0;

    public function __construct(
        \WebServCo\DiscogsData\Interfaces\DataProcessorInterface $dataProcessor,
        \WebServCo\Framework\Interfaces\LoggerInterface $logger,
        $filePath
    ) {
        if (!is_readable($filePath)) {
            throw new DataParserException(sprintf('File path not readable: %s', $filePath));
        }
        $this->dataProcessor = $dataProcessor;
        $this->logger = $logger;
        $this->filePath = $filePath;

        $this->xmlReader = new \XMLReader();
        if (!$this->xmlReader->open(sprintf('compress.zlib://%s', $this->filePath))) {
            throw new DataParserException(sprintf('Error opening file: %s', $filePath));
        }
    }

    public function run()
    {
        $dataType = $this->dataProcessor->getDataType();
        while ($this->xmlReader->read()) {
            ++ $this->xmlNodeCount;
            if (\XMLReader::ELEMENT == $this->xmlReader->nodeType && $dataType == $this->xmlReader->name) {
                ++ $this->xmlItemCount;
                $callable = [$this->dataProcessor, 'processItem'];
                if (!is_callable($callable)) {
                    throw new DataParserException('Data processor method not found');
                }
                $args = [$this->xmlReader->expand()];
                $result = call_user_func_array($callable, $args);
                if ($result) {
                    ++ $this->xmlProcessedCount;
                }
                $this->xmlReader->next();
            }
        }
        $this->xmlReader->close();
        return;
    }
}
