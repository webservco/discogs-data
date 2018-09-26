<?php
namespace WebServCo\DiscogsData\Interfaces;

interface DataProcessorInterface
{
    public function getDataType();
    public function processItem($data);
}
