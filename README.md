# webservco/discogs-data
Utilities for working with the Discogs monthly data dumps (parse, process, import).
> Require the compressed data dump files (xml.gz)

## Development install
```
git clone git@github.com:webservco/discogs-data.git
cd discogs-data-parser
composer install
```

## Run examples
```
php examples/releases.php count
php examples/releases.php process
```

### TODO
- (?) add functionality to process only some items (start/end index);
- add processing time info;
