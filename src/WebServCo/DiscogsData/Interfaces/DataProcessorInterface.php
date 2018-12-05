<?php
namespace WebServCo\DiscogsData\Interfaces;

interface DataProcessorInterface
{
    public function getDataType();

    public function finish();

    /*
    * @param \DOMElement $domElement
    * @return bool
    */
    public function processItem(\DOMElement $domElement);

    public function start();
}
