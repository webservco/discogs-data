# webservco/discogs-data

Utilities for working with the Discogs monthly data dumps (parse, process).

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

### Monthly data dumps item totals

* [2019](/docs/Statistics/2019.md)
* [2020](/docs/Statistics/2020.md)
* [2021](/docs/Statistics/2021.md)

---
