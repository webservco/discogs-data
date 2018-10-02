<?php
namespace WebServCo\DiscogsData;

abstract class AbstractDataProcessor
{
    protected $logger;
    protected $totalItems;

    public function __construct(\WebServCo\Framework\Interfaces\LoggerInterface $logger)
    {
        $this->logger = $logger;
        $this->totalItems = 0;
    }
}
