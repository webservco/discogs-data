# Examples
```
bin/example {type} {processor} {date}
```
Alternatively, if you have a custom PHP version:
```
{phpPath} examples/discogsData.php {type} {processor} {date}
```

---

## Notes

> Store the downloaded uncompressed (.xml.gz) data files in `var/data`.

> Debug data is stored in `var/tmp/debug/{dataType}`.

> Stop the procedure at any time by deleting it's `pid` file.

---

## Releases

### Count releases
```
bin/example Releases Counter 2018-12-01
```

### Debug releases
> This method saves an XML file for each item.

```
bin/example Releases Debugger 2018-12-01
```

### Process releases
```
bin/example Releases Processor 2018-12-01
```

---

## Masters

### Count masters
```
bin/example Masters Counter 2018-12-01
```

### Debug masters
> This method saves an XML file for each item.

```
bin/example Masters Debugger 2018-12-01
```

---
