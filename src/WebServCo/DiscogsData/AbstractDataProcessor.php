<?php
namespace WebServCo\DiscogsData;

abstract class AbstractDataProcessor
{
    protected $logger;
    protected $outputDirectory;
    protected $progressLine;
    protected $totalItems;

    public function __construct(\WebServCo\Framework\Interfaces\LoggerInterface $logger, $outputDirectory)
    {
        $this->logger = $logger;
        $this->outputDirectory = $outputDirectory;
        $this->progressLine = new \WebServCo\Framework\Cli\Progress\Line();
        $this->progressLine->setShowResult(false);
        $this->totalItems = 0;
    }

    public function finish()
    {
        $this->progressLine->finish(); //pl finish
    }

    /*
    * @param \DOMElement $domElement
    * @return bool
    */
    public function processItem(\DOMElement $domElement)
    {
        ++ $this->totalItems;
    }

    public function start()
    {
    }

    protected function saveXml(\DOMElement $domElement)
    {
        if (!$domElement->hasAttribute(DataAttributes::ID)) {
            throw new \WebServCo\DiscogsData\Exceptions\DataProcessorException(
                sprintf('Item is missing required attribute "%s"', DataAttributes::ID)
            );
        }
        $xml = new \WebServCo\Framework\Files\XmlFileFromDomElement(
            sprintf('%s.xml', $domElement->getAttribute(DataAttributes::ID)),
            $domElement,
            true
        );
        return file_put_contents($this->outputDirectory . $xml->getFileName(), $xml->getFileData());
    }
}
