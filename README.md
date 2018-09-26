# webservco/discogs-data
Utilities for working with the Discogs monthly data dumps (parse, process, import).

## Development install
```
git clone git@github.com:webservco/discogs-data.git
cd discogs-data-parser
composer install
```

## Run examples
```
php public/processReleasesExample.php
```

### TODO
- handle checksum;
- function to count how many releases in the data dump;
