# DiscogsData

## Notes
* Keep data XML (.xml.gz);
* Store data XML in `var/data`;

---

## Examples
```
bin/example {type} {processor} {filePath}
```
Alternatively, if you have a custom PHP version:
```
{phpPath} examples/discogsData.php {type} {processor} {filePath}
```

## Releases

### Count releases
```
bin/example releases counter discogs_20181201_releases.xml.gz
```

### Process releases
```
bin/example releases processor discogs_20181201_releases.xml.gz
```

---
