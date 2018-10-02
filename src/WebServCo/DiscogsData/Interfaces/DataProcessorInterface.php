<?php
namespace WebServCo\DiscogsData\Interfaces;

interface DataProcessorInterface
{
    public function getDataType();
    public function start();
    /*
    * @param mixed $data
    * @return bool
    */
    public function processItem($data);
    public function finish();
}
