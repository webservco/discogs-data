# webservco/discogs-data

A PHP library for [webservco/framework](https://github.com/webservco/framework).

Streams the compressed [Discogs monthly data dumps](https://data.discogs.com/) (artists, labels, masters, releases) and passes each XML item to a processor.

> **Note:** `webservco/framework` is considered legacy. It has been replaced by individual components, please see [webservco/sandbox](https://webservco.github.io/sandbox/).

- Requires: PHP 8.3+, `ext-xmlreader`, `ext-zlib`, `ext-dom`, `ext-simplexml`, a writable `var/run` directory for the CLI runner

---

## Installation

```shell
composer require webservco/discogs-data
```

---

## Usage

```php
use WebServCo\DiscogsData\Data\Parser;
use WebServCo\DiscogsData\Processors\Releases\Counter;
use WebServCo\Framework\Cli\Runner\Runner;
use WebServCo\Framework\Log\CliOutputLogger;

$logger = new CliOutputLogger();

// \WebServCo\DiscogsData\Interfaces\DataProcessorInterface
$processor = new Counter($logger, sprintf('%svar/tmp/debug/releases/', $projectPath));

$parser = new Parser(
    // \WebServCo\Framework\Interfaces\CliRunnerInterface, writes its pid file here.
    new Runner(sprintf('%svar/run/', $projectPath)),
    $processor,
    $logger,
    sprintf('%svar/data/discogs_20190801_releases.xml.gz', $projectPath),
);
// Logs item count, running time and memory peak usage when done.
$result = $parser->run();
```

You don't need to extract the `.xml.gz` file first, because the parser reads it compressed. To stop a run early, delete the runner's pid file.

### Write a processor

Extend the `AbstractProcessor` of a data type and implement `processItemCustom()`. Return `true` to count the item as processed.

```php
use DOMElement;
use WebServCo\DiscogsData\Interfaces\DataProcessorInterface;
use WebServCo\DiscogsData\Processors\Releases\AbstractProcessor;

final class ExampleProcessor extends AbstractProcessor implements DataProcessorInterface
{
    protected function processItemCustom(DOMElement $domElement): bool
    {
        $id = $this->getDomElementId($domElement);
        // $this->toJson($domElement) or $this->saveXml($id, $domElement)

        return true;
    }
}
```

---

## Contracts

| Interface | Implementation | Purpose |
| --- | --- | --- |
| `Interfaces\DataProcessorInterface` | `Processors\{Type}\Counter` | Counts the items, writes nothing. |
| `Interfaces\DataProcessorInterface` | `Processors\{Type}\Debugger` | Saves each item to `{id}.xml` in the output directory. |
| | `Data\Parser` | Reads the dump and calls the processor for each item. |

`{Type}` is `Artists`, `Labels`, `Masters` or `Releases`. Namespaces are relative to `WebServCo\DiscogsData\`.

---

## Notes

When the logger is an output logger (like `CliOutputLogger`), processors print progress every 1000 items.

`Counter` still needs an output directory, even though it doesn't write anything there.

### Example script

To try it, clone the project, put the downloaded dumps in `var/data/`, create the output directory and run:

```shell
mkdir -p var/tmp/debug/releases
bin/example Releases Counter 2019-08-01
```

The arguments are the type, the processor and the dump date. The script looks for `var/data/discogs_20190801_releases.xml.gz`. See [examples/discogsData.php](examples/discogsData.php).

---

## Documentation

- [Usage](docs/Usage.md): The parser and processors.
- [Examples](docs/Examples.md): Example commands for each data type and processor.
- [Todo](docs/Todo.md): Planned changes.

---

## Development

```shell
# Start project.
ddev start
# Install dependencies.
ddev c u
# Run all validations.
ddev c c
# Run unit tests.
ddev c test:d
```

---

## License

[MIT](LICENSE)
