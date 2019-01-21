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
git clone git@github.com:webservco/discogs-data.git
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

## Statistics

### Monthly data dumps item totals

| 2019    | Artists   | Labels    | Masters   | Releases   |
|---------|-----------|-----------|-----------|------------|
| January | 6 034 590 | 1 309 292 | 1 444 467 | 10 668 146 |
