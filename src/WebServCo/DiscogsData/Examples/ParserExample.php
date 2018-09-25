<?php
namespace WebServCo\DiscogsData\Examples;

final class ParserExample
{
    protected $discogsDataParser;

    public function __construct($xmlPath)
    {
        $this->discogsDataParser = new \WebServCo\DiscogsData\Parser(
            $xmlPath,
            [$this, 'processItem']
        );
    }

    public function run()
    {
        $this->discogsDataParser->run();
    }

    public function processItem($data)
    {
        print_r($data); //XXX
        echo PHP_EOL;
    }
}
