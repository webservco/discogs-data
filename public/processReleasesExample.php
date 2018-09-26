<?php
require __DIR__ . '/../vendor/autoload.php';

try {
    //$xmlPath = isset($_SERVER['argv'][1]) ? $_SERVER['argv'][1]: null;
    $xmlPath = __DIR__ . '/../var/data/discogs_20180901_releases.xml.gz';
    $logger = new \WebServCo\Framework\FileLogger(
        'discogs-data',
        __DIR__ . '/../var/log/',
        \WebServCo\Framework\Framework::library('Request')
    );
    $releaseProcessor = new \WebServCo\DiscogsData\ReleasesProcessor();
    $xmlParser = new \WebServCo\DiscogsData\XmlParser(
        $releaseProcessor,
        $logger,
        $xmlPath
    );
    $xmlParser->run();
} catch (\WebServCo\DiscogsData\Exceptions\XmlParserException $e) {
    echo $e->getMessage();
    echo PHP_EOL;
}
