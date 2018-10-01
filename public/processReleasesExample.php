<?php
require __DIR__ . '/../vendor/autoload.php';

try {
    //$xmlPath = isset($_SERVER['argv'][1]) ? $_SERVER['argv'][1]: null;
    $filePath = __DIR__ . '/../var/data/discogs_20180901_releases.xml.gz';
    $logger = new \WebServCo\Framework\FileLogger(
        'discogs-data',
        __DIR__ . '/../var/log/',
        \WebServCo\Framework\Framework::library('Request')
    );
    $releasesProcessor = new \WebServCo\DiscogsData\ReleasesProcessor();
    $dataParser = new \WebServCo\DiscogsData\DataParser(
        $releasesProcessor,
        $logger,
        $filePath
    );
    $dataParser->run();
} catch (\WebServCo\DiscogsData\Exceptions\DataParserException $e) {
    echo sprintf('Error: %s%s', $e->getMessage(), PHP_EOL);
}
