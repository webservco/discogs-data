# Examples

* Install the project locally.

## Run

```sh
bin/example {type} {processor} {date}
```

Alternatively, if you have a custom PHP version:

```sh
{phpPath} examples/discogsData.php {type} {processor} {date}
```

---

## Notes

* Store the downloaded uncompressed (.xml.gz) data files in `var/data`.

* Debug data is stored in `var/tmp/debug/{dataType}`.

* Stop the procedure at any time by deleting it's `pid` file.

---

## Artists

### Count artists

```sh
bin/example Artists Counter 2019-08-01
```

### Debug artists

* This method saves an XML file for each item.

```sh
bin/example Artists Debugger 2019-08-01
```

---

## Labels

### Count labels

```sh
bin/example Labels Counter 2019-08-01
```

### Debug labels

* This method saves an XML file for each item.

```sh
bin/example Labels Debugger 2019-08-01
```

---

## Masters

### Count masters

```sh
bin/example Masters Counter 2019-08-01
```

### Debug masters

* This method saves an XML file for each item.

```sh
bin/example Masters Debugger 2019-08-01
```

---

## Releases

### Count releases

```sh
bin/example Releases Counter 2019-08-01
```

### Debug releases

* This method saves an XML file for each item.

```sh
bin/example Releases Debugger 2019-08-01
```

---

[README](../README.md)
