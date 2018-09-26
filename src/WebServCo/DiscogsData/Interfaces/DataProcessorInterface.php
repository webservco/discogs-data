<?php
namespace WebServCo\DiscogsData\Interfaces;

interface DataProcessorInterface
{
    public function processItem($xmlData);
}
