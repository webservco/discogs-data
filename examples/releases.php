<?php
$projectPath = realpath(__DIR__ . '/..') . DIRECTORY_SEPARATOR;

require $projectPath . 'vendor/autoload.php';

$exampleType = isset($_SERVER['argv'][1]) ? $_SERVER['argv'][1]: null;
$fileName = isset($_SERVER['argv'][2]) ? $_SERVER['argv'][2]: null;

if (empty($exampleType) || empty($fileName)) {
    exit('Error: missing parameters' . PHP_EOL);
}

$filePath = sprintf('%svar/data/%s', $projectPath, $fileName);

$logger = new \WebServCo\Framework\OutputLogger();

try {
    /*
    $fileLogger = new \WebServCo\Framework\FileLogger(
        'discogs-data',
        __DIR__ . '/../var/log/',
        \WebServCo\Framework\Framework::library('Request')
    );
    */
    $cliRunner = new \WebServCo\Framework\Cli\Runner\Runner(sprintf('%svar/run/', $projectPath));
    $outputDirectory = sprintf('%svar/tmp/releases/', $projectPath);
    switch ($exampleType) {
        case 'process':
            $dataProcessor = new \WebServCo\DiscogsData\ReleasesProcessor($logger, $outputDirectory);
            break;
        case 'count':
        default:
            $dataProcessor = new \WebServCo\DiscogsData\ReleasesCounter($logger, $outputDirectory);
            break;
    }

    $dataParser = new \WebServCo\DiscogsData\DataParser(
        $cliRunner,
        $dataProcessor,
        $logger,
        $filePath
    );
    $dataParser->run();
} catch (\WebServCo\DiscogsData\Exceptions\DiscogsDataException $e) {
    $logger->error(sprintf('Error: %s%s', $e->getMessage(), PHP_EOL));
}
