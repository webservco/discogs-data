<?php
require __DIR__ . '/../vendor/autoload.php';

try {
    //$xmlPath = isset($_SERVER['argv'][1]) ? $_SERVER['argv'][1]: null;
    $xmlPath = __DIR__ . '/../var/data/';
    $logger = new \WebServCo\Framework\FileLogger(
        'discogs-data-parser',
        __DIR__ . '/../var/log/',
        \WebServCo\Framework\Framework::library('Request')
    );
    $parserExample = new \WebServCo\DiscogsData\Examples\ParserExample(
        $xmlPath
    );
    $parserExample->run();
} catch (\WebServCo\DiscogsData\Exceptions\ParserException $e) {
    echo $e->getMessage();
    echo PHP_EOL;
}
