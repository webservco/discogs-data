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

### 2019 Monthly data dumps item totals

#### Artists

| Month    | Total     | Difference |
|----------|-----------|------------|
| January  | 6 034 590 |            |
| February | 6 091 081 | + 56 491   |

#### Labels

| Month    | Total     | Difference |
|----------|-----------|------------|
| January  | 1 309 292 |            |
| February | 1 323 716 | + 14 424   |

#### Masters

| Month    | Total     | Difference |
|----------|-----------|------------|
| January  | 1 444 467 |            |
| February | 1 461 073 | + 16 606   |

#### Releases

| Month    | Total      | Difference |
|----------|------------|------------|
| January  | 10 668 146 |            |
| February | 10 785 723 | + 117 577  |
