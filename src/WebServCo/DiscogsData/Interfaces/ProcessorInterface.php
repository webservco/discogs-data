<?php
namespace WebServCo\DiscogsData\Interfaces;

interface ProcessorInterface
{
    public function processItem($xmlData);
}
