<?php
namespace WebServCo\DiscogsData;

use \WebServCo\DiscogsData\Exceptions\XmlParserException;

final class XmlParser
{
    protected $dataProcessor;
    protected $logger;
    protected $xmlPath;

    protected $xmlReader;

    public function __construct(
        \WebServCo\DiscogsData\Interfaces\DataProcessorInterface $dataProcessor,
        \WebServCo\Framework\Interfaces\LoggerInterface $logger,
        $xmlPath
    ) {
        if (!is_readable($xmlPath)) {
            throw new XmlParserException(sprintf('XML path not readable: %s', $xmlPath));
        }
        $this->dataProcessor = $dataProcessor;
        $this->logger = $logger;
        $this->xmlPath = $xmlPath;

        $this->xmlReader = new \XMLReader();
    }

    public function run()
    {
        $data = [
            'xmlPath' => $this->xmlPath,
        ];
        $args = [$data];
        $callable = [$this->dataProcessor, 'processItem'];
        if (!is_callable($callable)) {
            throw new XmlParserException('Processor method not found');
        }
        return call_user_func_array($callable, $args);
    }
}
