<?php
namespace WebServCo\DiscogsData;

use WebServCo\DiscogsData\Data\Attributes;
use WebServCo\DiscogsData\Exceptions\DataProcessorException;
use WebServCo\Framework\Interfaces\OutputLoggerInterface;

abstract class AbstractDataProcessor
{
    const DATA_TYPE = null;

    protected $logger;
    protected $outputDirectory;
    protected $progressLine;
    protected $totalItems;

    public function __construct(\WebServCo\Framework\Interfaces\LoggerInterface $logger, $outputDirectory)
    {
        $this->logger = $logger;
        $this->outputDirectory = $outputDirectory;

        if ($this->logger instanceof OutputLoggerInterface) {
            $this->progressLine = new \WebServCo\Framework\Cli\Progress\Line();
            $this->progressLine->setShowResult(false);
        }

        $this->totalItems = 0;
    }

    public function finish()
    {
        if ($this->logger instanceof OutputLoggerInterface) {
            $this->progressLine->finish(); //pl finish
        }
    }

    public function getDataType()
    {
        return static::DATA_TYPE; //using a metohd because we are implementing an interface
    }

    /*
    * @param \DOMElement $domElement
    * @return bool
    */
    public function processItem(\DOMElement $domElement)
    {
        ++ $this->totalItems;

        $outputCheck = $this->totalItems%1000;
        if (empty($outputCheck)) { // output every 1000 items
            if ($this->logger instanceof OutputLoggerInterface) {
                $this->logger->output(
                    $this->progressLine->prefix(sprintf('Processing item %s', $this->totalItems)), // pl prefix
                    false // eol
                );
            }
        }

        $result = $this->processItemCustom($domElement);

        if (empty($outputCheck)) { // output every 1000 items
            if ($this->logger instanceof OutputLoggerInterface) {
                $this->logger->output(
                    $this->progressLine->suffix($result),
                    false // eol
                ); // pl suffix
            }
        }
        return $result;
    }

    public function start()
    {
    }

    abstract protected function processItemCustom(\DOMElement $domElement);

    protected function saveXml(\DOMElement $domElement)
    {
        if (!$domElement->hasAttribute(Attributes::ID)) {
            throw new DataProcessorException(
                sprintf('Item is missing required attribute "%s"', Attributes::ID)
            );
        }
        $xml = new \WebServCo\Framework\Files\XmlFileFromDomElement(
            sprintf('%s.xml', $domElement->getAttribute(Attributes::ID)),
            $domElement,
            true
        );
        return file_put_contents($this->outputDirectory . $xml->getFileName(), $xml->getFileData());
    }
}
