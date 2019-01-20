# Usage

---

## Data parser
`\WebServCo\DiscogsData\Data\Parser`

- parses the compressed monthly XML data dumps;
- calls a data processor for each XML item;

### Arguments
* `\WebServCo\Framework\Interfaces\CliRunnerInterface`
* `\WebServCo\DiscogsData\Interfaces\DataProcessorInterface`
* `\WebServCo\Framework\Interfaces\LoggerInterface`
* File path

---

## Data processor
- processes each XML item extracted by the data parser;
