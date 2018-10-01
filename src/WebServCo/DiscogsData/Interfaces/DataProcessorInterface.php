<?php
namespace WebServCo\DiscogsData\Interfaces;

interface DataProcessorInterface
{
    public function getDataType();
    public function start();
    public function processItem($data);
    public function finish();
}
