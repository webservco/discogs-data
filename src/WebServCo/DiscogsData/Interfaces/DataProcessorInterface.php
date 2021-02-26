<?php

declare(strict_types=1);

namespace WebServCo\DiscogsData\Interfaces;

interface DataProcessorInterface
{
    public function finish(): void;

    public function getDataType(): void;

    /*
    * @param \DOMElement $domElement
    * @return bool
    */
    public function processItem(\DOMElement $domElement): void;

    public function start(): void;
}
