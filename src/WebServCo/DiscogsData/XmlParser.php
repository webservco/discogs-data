<?php
namespace WebServCo\DiscogsData;

use \WebServCo\DiscogsData\Exceptions\XmlParserException;

final class XmlParser
{
    protected $xmlPath;
    protected $processor;

    public function __construct($xmlPath, \WebServCo\DiscogsData\Interfaces\ProcessorInterface $processor)
    {
        if (!is_readable($xmlPath)) {
            throw new XmlParserException(sprintf('XML path not readable: %s', $xmlPath));
        }
        $this->xmlPath = $xmlPath;
        $this->processor = $processor;
    }

    public function run()
    {
        $data = [
            'xmlPath' => $this->xmlPath,
        ];
        $args = [$data];
        $callable = [$this->processor, 'processItem'];
        if (!is_callable($callable)) {
            throw new XmlParserException('Processor method not found');
        }
        return call_user_func_array($callable, $args);
    }
}
