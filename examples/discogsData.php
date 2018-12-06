<?php

use WebServCo\DiscogsData\Exceptions\DiscogsDataException;
use WebServCo\Framework\Cli\Ansi;
use WebServCo\Framework\Cli\Sgr;

$projectPath = realpath(__DIR__ . '/..') . DIRECTORY_SEPARATOR;

require $projectPath . 'vendor/autoload.php';

/* Configuration */

$examples = [
    'Artists' => [
        'Counter',
        'Debugger',
    ],
    'Labels' => [
        'Counter',
        'Debugger',
    ],
    'Masters' => [
        'Counter',
        'Debugger',
    ],
    'Releases' => [
        'Counter',
        'Debugger',
    ],
];
$errorMessages = [
    'missingParameter' => 'Missing parameter: %s',
    'invalidParameter' => 'Invalid parameter: %s',
];

/* Set up */

$type = isset($_SERVER['argv'][1]) ? $_SERVER['argv'][1] : null;
$processor = isset($_SERVER['argv'][2]) ? $_SERVER['argv'][2] : null;
$date = isset($_SERVER['argv'][3]) ? $_SERVER['argv'][3]: null;

/* Output */

$logger = new \WebServCo\Framework\CliOutputLogger();
$logger->clear();
$logger->debug(Ansi::sgr('Discogs Data: example', [Sgr::BOLD]));

/* Validation */

try {
    if (empty($type)) {
        throw new DiscogsDataException(sprintf($errorMessages['missingParameter'], 'type (1)'));
    }
    if (!array_key_exists($type, $examples)) {
        throw new DiscogsDataException(sprintf($errorMessages['invalidParameter'], 'type (1)'));
    }
    if (empty($processor)) {
        throw new DiscogsDataException(sprintf($errorMessages['missingParameter'], 'processor (2)'));
    }
    foreach ($examples as $exampleType => $processors) {
        if (!in_array($processor, $processors)) {
            throw new DiscogsDataException(sprintf($errorMessages['invalidParameter'], 'processor (2)'));
        }
    }
    if (empty($date)) {
        throw new DiscogsDataException(sprintf($errorMessages['missingParameter'], 'date (3)'));
    }
} catch (DiscogsDataException $e) {
    $logger->debug(Ansi::sgr(sprintf('Error: %s', $e->getMessage()), [Sgr::RED]));
    exit;
}

/* Run */

try {
    $cliRunner = new \WebServCo\Framework\Cli\Runner\Runner(sprintf('%svar/run/', $projectPath));
    $outputDirectory = sprintf('%svar/tmp/debug/%s/', $projectPath, strtolower($type));
    if (!is_writable($outputDirectory)) {
        throw new DiscogsDataException(sprintf('Output directory not writable: %s', $outputDirectory));
    }

    $className = sprintf('\\WebServCo\\DiscogsData\\%s\\%s', $type, $processor);
    $dataProcessor = new $className($logger, $outputDirectory);

    $filePath = sprintf(
        '%svar/data/discogs_%s_%s.xml.gz',
        $projectPath,
        str_replace('-', '', $date),
        strtolower($type)
    );
    $dataParser = new \WebServCo\DiscogsData\Data\Parser(
        $cliRunner,
        $dataProcessor,
        $logger,
        $filePath
    );
    $dataParser->run();
} catch (DiscogsDataException $e) {
    $logger->error(sprintf('Error: %s%s', $e->getMessage(), PHP_EOL));
}
