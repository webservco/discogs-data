<?php
require __DIR__ . '/../vendor/autoload.php';

$exampleType = isset($_SERVER['argv'][1]) ? $_SERVER['argv'][1]: 'count';

$outputLogger = new \WebServCo\Framework\OutputLogger();
try {
    $filePath = __DIR__ . '/../var/data/discogs_20180901_releases.xml.gz';
    $fileLogger = new \WebServCo\Framework\FileLogger(
        'discogs-data',
        __DIR__ . '/../var/log/',
        \WebServCo\Framework\Framework::library('Request')
    );

    switch ($exampleType) {
        case 'process':
            $dataProcessor = new \WebServCo\DiscogsData\ReleasesProcessor($outputLogger);
            break;
        case 'count':
        default:
            $dataProcessor = new \WebServCo\DiscogsData\ReleasesCounter($outputLogger);
            break;
    }

    $dataParser = new \WebServCo\DiscogsData\DataParser(
        $dataProcessor,
        $fileLogger,
        $filePath
    );
    $dataParser->run();
} catch (\WebServCo\DiscogsData\Exceptions\DiscogsDataException $e) {
    $outputLogger->error(sprintf('Error: %s%s', $e->getMessage(), PHP_EOL));
}
