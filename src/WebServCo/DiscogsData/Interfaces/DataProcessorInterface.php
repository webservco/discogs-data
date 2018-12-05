<?php
namespace WebServCo\DiscogsData\Interfaces;

interface DataProcessorInterface
{
    public function finish();

    public function getDataType();

    /*
    * @param \DOMElement $domElement
    * @return bool
    */
    public function processItem(\DOMElement $domElement);

    public function start();
}
