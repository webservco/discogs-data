<?php
namespace WebServCo\DiscogsData;

abstract class AbstractDataProcessor
{
    protected $totalItems = 0;

    public function __construct()
    {
        $this->totalItems = 0;
    }
}
