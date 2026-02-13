<?php

declare(strict_types=1);

namespace WebServCo\DiscogsData\Processors;

use DOMDocument;
use DOMElement;
use DOMNode;
use WebServCo\DiscogsData\Data\Attributes;
use WebServCo\DiscogsData\Data\Tags;
use WebServCo\Framework\Cli\Progress\Line;
use WebServCo\Framework\Files\XmlFileFromDomElement;
use WebServCo\Framework\Interfaces\LoggerInterface;
use WebServCo\Framework\Interfaces\OutputLoggerInterface;

use function file_put_contents;
use function json_encode;
use function md5;
use function simplexml_import_dom;
use function sprintf;

abstract class AbstractDataProcessor
{
    public const string DATA_TYPE = '';

    protected Line $progressLine;
    protected int $totalItems;

    abstract protected function processItemCustom(DOMElement $domElement): bool;

    public function __construct(protected LoggerInterface $logger, protected string $outputDirectory)
    {
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
            //pl finish
            $this->progressLine->finish(),
        );
    }

    public function getDataType(): string
    {
        // phpcs:ignore SlevomatCodingStandard.Classes.DisallowLateStaticBindingForConstants.DisallowedLateStaticBindingForConstant
        //using a method because we are implementing an interface
        return self::DATA_TYPE;
    }

    public function processItem(DOMElement $domElement): bool
    {
        // phpcs:ignore SlevomatCodingStandard.Operators.DisallowIncrementAndDecrementOperators.DisallowedPreIncrementOperator
        ++$this->totalItems;

        $outputCheck = $this->totalItems % 1000;
        // output every 1000 items
        if (empty($outputCheck)) {
            if ($this->logger instanceof OutputLoggerInterface) {
                $this->logger->output(
                    // pl prefix
                    $this->progressLine->prefix(sprintf('Processing item %s', $this->totalItems)),
                    // eol
                    false,
                );
            }
        }

        $result = $this->processItemCustom($domElement);

        // output every 1000 items
        if (empty($outputCheck)) {
            if ($this->logger instanceof OutputLoggerInterface) {
                $this->logger->output(
                    $this->progressLine->suffix($result),
                    // eol
                    false,
                    // pl suffix
                );
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
    protected function getDomElementId(DOMElement $domElement): string
    {
        // check for attribute
        if ($domElement->hasAttribute(Attributes::ID)) {
            return $domElement->getAttribute(Attributes::ID);
        }
        // check for tag
        $nodes = $domElement->getElementsByTagName(Tags::ID);
        if ($nodes->length) {
            if ($nodes->item(0) instanceof DOMNode) {
                return (string) $nodes->item(0)->nodeValue;
            }
        }

        // default to md5 hash
        return md5((string) $domElement->nodeValue);
    }

    protected function saveXml(string $id, DOMElement $domElement): bool
    {
        $xml = new XmlFileFromDomElement(
            sprintf('%s.xml', $id),
            $domElement,
            true,
        );
        $result = file_put_contents($this->outputDirectory . $xml->getFileName(), $xml->getFileData());

        return $result !== false;
    }

    protected function toJson(DOMElement $domElement): string
    {
        $domDocument = new DOMDocument();
        $domDocument->preserveWhiteSpace = false;
        $domDocument->formatOutput = true;
        $element = $domDocument->importNode($domElement, true);
        $domDocument->appendChild($element);
        // SimpleXMLElement
        $simpleXMLElement = simplexml_import_dom($domDocument);

        return (string) json_encode($simpleXMLElement);
    }
}
