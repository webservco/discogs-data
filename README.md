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

## Statistics

### 2019 Monthly data dumps item totals

#### Artists

| Month    | Total     | Difference |
|----------|-----------|------------|
| January  | 6 034 590 |            |
| February | 6 091 081 | + 56 491   |
| March    | 6 138 995 | + 47 914   |
| April    | 6 195 058 | + 56 063   |

#### Labels

| Month    | Total     | Difference |
|----------|-----------|------------|
| January  | 1 309 292 |            |
| February | 1 323 716 | + 14 424   |
| March    | 1 336 346 | + 12 630   |
| April    | 1 350 775 | + 14 429   |

#### Masters

| Month    | Total     | Difference |
|----------|-----------|------------|
| January  | 1 444 467 |            |
| February | 1 461 073 | + 16 606   |
| March    | 1 475 843 | + 14 770   |
| April    | 1 492 769 | + 16 926   |

#### Releases

| Month    | Total      | Difference |
|----------|------------|------------|
| January  | 10 668 146 |            |
| February | 10 785 723 | + 117 577  |
| March    | 10 893 841 | + 108 118  |
| April    | 11 019 051 | + 125 210  |

---
