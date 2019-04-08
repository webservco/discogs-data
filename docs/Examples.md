# Examples

> Install the project locally.

## Run

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

## Artists

### Count artists
```
bin/example Artists Counter 2019-04-02
```

### Debug artists
> This method saves an XML file for each item.

```
bin/example Artists Debugger 2019-04-02
```

---

## Labels

### Count labels
```
bin/example Labels Counter 2019-04-02
```

### Debug labels
> This method saves an XML file for each item.

```
bin/example Labels Debugger 2019-04-02
```

---

## Masters

### Count masters
```
bin/example Masters Counter 2019-04-02
```

### Debug masters
> This method saves an XML file for each item.

```
bin/example Masters Debugger 2019-04-02
```

---

## Releases

### Count releases
```
bin/example Releases Counter 2019-04-02
```

### Debug releases
> This method saves an XML file for each item.

```
bin/example Releases Debugger 2019-04-02
```

---
