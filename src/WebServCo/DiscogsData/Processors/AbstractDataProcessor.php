<?php

declare(strict_types=1);

namespace WebServCo\DiscogsData\Processors;

use WebServCo\DiscogsData\Data\Attributes;
use WebServCo\Framework\Cli\Progress\Line;
use WebServCo\Framework\Interfaces\LoggerInterface;
use WebServCo\Framework\Interfaces\OutputLoggerInterface;

abstract class AbstractDataProcessor
{
    public const DATA_TYPE = '';

    protected LoggerInterface $logger;
    protected string $outputDirectory;
    protected Line $progressLine;
    protected int $totalItems;

    abstract protected function processItemCustom(\DOMElement $domElement): bool;

    public function __construct(LoggerInterface $logger, string $outputDirectory)
    {
        $this->logger = $logger;
        $this->outputDirectory = $outputDirectory;

        if ($this->logger instanceof OutputLoggerInterface) {
            $this->progressLine = new Line();
            $this->progressLine->setShowResult(false);
        }

        $this->totalItems = 0;
    }

    public function finish(): void
    {
        if (!($this->logger instanceof OutputLoggerInterface)) {
            return;
        }

        $this->logger->output(
            $this->progressLine->finish(), //pl finish
        );
    }

    public function getDataType(): string
    {
        // phpcs:ignore SlevomatCodingStandard.Classes.DisallowLateStaticBindingForConstants.DisallowedLateStaticBindingForConstant
        return static::DATA_TYPE; //using a method because we are implementing an interface
    }

    public function processItem(\DOMElement $domElement): bool
    {
        // phpcs:ignore SlevomatCodingStandard.Operators.DisallowIncrementAndDecrementOperators.DisallowedPreIncrementOperator
        ++$this->totalItems;

        $outputCheck = $this->totalItems % 1000;
        if (empty($outputCheck)) { // output every 1000 items
            if ($this->logger instanceof OutputLoggerInterface) {
                $this->logger->output(
                    $this->progressLine->prefix(\sprintf('Processing item %s', $this->totalItems)), // pl prefix
                    false, // eol
                );
            }
        }

        $result = $this->processItemCustom($domElement);

        if (empty($outputCheck)) { // output every 1000 items
            if ($this->logger instanceof OutputLoggerInterface) {
                $this->logger->output(
                    $this->progressLine->suffix($result),
                    false, // eol
                ); // pl suffix
            }
        }
        return $result;
    }

    public function start(): void
    {
        // No content.
    }

    /**
     * Extract item id from XML node.
     * Try to find a tag named "id".
     * Releases and masters have also an attibute named "id", that is checked first.
     * Defaults to an md5 hash of the content.
     */
    protected function getDomElementId(\DOMElement $domElement): string
    {
        // check for attribute
        if ($domElement->hasAttribute(Attributes::ID)) {
            return $domElement->getAttribute(Attributes::ID);
        }
        // check for tag
        $nodes = $domElement->getElementsByTagName(\WebServCo\DiscogsData\Data\Tags::ID);
        if ($nodes->length) {
            if ($nodes->item(0) instanceof \DOMNode) {
                return $nodes->item(0)->nodeValue;
            }
        }
        // default to md5 hash
        return \md5($domElement->nodeValue);
    }

    protected function saveXml(string $id, \DOMElement $domElement): bool
    {
        $xml = new \WebServCo\Framework\Files\XmlFileFromDomElement(
            \sprintf('%s.xml', $id),
            $domElement,
            true,
        );
        $result = \file_put_contents($this->outputDirectory . $xml->getFileName(), $xml->getFileData());
        return false !== $result;
    }

    protected function toJson(\DOMElement $domElement): string
    {
        $domDocument = new \DOMDocument();
        $domDocument->preserveWhiteSpace = false;
        $domDocument->formatOutput = true;
        $element = $domDocument->importNode($domElement, true);
        $domDocument->appendChild($element);
        $simpleXMLElement = \simplexml_import_dom($domDocument); // SimpleXMLElement
        return (string) \json_encode($simpleXMLElement);
    }
}
