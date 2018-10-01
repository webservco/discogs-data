<?php
require __DIR__ . '/../vendor/autoload.php';

$exampleType = isset($_SERVER['argv'][1]) ? $_SERVER['argv'][1]: 'count';

try {
    $filePath = __DIR__ . '/../var/data/discogs_20180901_releases.xml.gz';
    $logger = new \WebServCo\Framework\FileLogger(
        'discogs-data',
        __DIR__ . '/../var/log/',
        \WebServCo\Framework\Framework::library('Request')
    );
    switch ($exampleType) {
        case 'process':
            $dataProcessor = new \WebServCo\DiscogsData\ReleasesProcessor();
            break;
        case 'count':
        default:
            $dataProcessor = new \WebServCo\DiscogsData\ReleasesCounter();
            break;
    }

    $dataParser = new \WebServCo\DiscogsData\DataParser(
        $dataProcessor,
        $logger,
        $filePath
    );
    $dataParser->run();
} catch (\WebServCo\DiscogsData\Exceptions\DataParserException $e) {
    echo sprintf('Error: %s%s', $e->getMessage(), PHP_EOL);
}
