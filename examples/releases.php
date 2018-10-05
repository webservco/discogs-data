<?php
require __DIR__ . '/../vendor/autoload.php';

$exampleType = isset($_SERVER['argv'][1]) ? $_SERVER['argv'][1]: 'count';

$filePath = __DIR__ . '/../var/data/discogs_20181001_releases.xml.gz';
$outputLogger = new \WebServCo\Framework\OutputLogger();

try {
    /*
    $fileLogger = new \WebServCo\Framework\FileLogger(
        'discogs-data',
        __DIR__ . '/../var/log/',
        \WebServCo\Framework\Framework::library('Request')
    );
    */
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
        $outputLogger,
        $filePath
    );
    $dataParser->run();
} catch (\WebServCo\DiscogsData\Exceptions\DiscogsDataException $e) {
    $outputLogger->error(sprintf('Error: %s%s', $e->getMessage(), PHP_EOL));
}
