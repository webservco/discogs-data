# DiscogsData

## Notes
* Store uncompressed (.xml.gz) data file in `var/data`;

---

## Examples
```
bin/example {type} {processor} {date}
```
Alternatively, if you have a custom PHP version:
```
{phpPath} examples/discogsData.php {type} {processor} {date}
```

## Releases

### Count releases
```
bin/example releases counter 2018-12-01
```

### Process releases
```
bin/example releases processor 2018-12-01
```

---
