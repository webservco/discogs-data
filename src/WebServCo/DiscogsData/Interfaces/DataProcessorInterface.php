<?php

declare(strict_types=1);

namespace WebServCo\DiscogsData\Interfaces;

use DOMElement;

interface DataProcessorInterface
{
    public function finish(): void;

    public function getDataType(): string;

    public function processItem(DOMElement $domElement): bool;

    public function start(): void;
}
