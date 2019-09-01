# webservco/discogs-data

Utilities for working with the Discogs monthly data dumps (parse, process, import).

## Current functionality

### Artists
- Count: `\WebServCo\DiscogsData\Processors\Artists\Counter`
- Debug: `\WebServCo\DiscogsData\Processors\Artists\Debugger`

### Labels
- Count `\WebServCo\DiscogsData\Processors\Labels\Counter`
- Debug `\WebServCo\DiscogsData\Processors\Labels\Debugger`

### Masters
- Count `\WebServCo\DiscogsData\Processors\Masters\Counter`
- Debug `\WebServCo\DiscogsData\Processors\Masters\Debugger`

### Releases
- Count `\WebServCo\DiscogsData\Processors\Releases\Counter`
- Debug `\WebServCo\DiscogsData\Processors\Releases\Debugger`

---

## Installation
```
composer require webservco/discogs-data
```

---

## Development install
```
git clone https://github.com/webservco/discogs-data.git
cd discogs-data
composer install
```

---

## Examples
[Examples](/docs/Examples.md)

---

## Usage
[TODO]

---

## Notes

* `Counter` still needs usable output directory, even though it doesn't actually write any data.

---

## Statistics

[Statistics](/docs/Statistics.md)

---
