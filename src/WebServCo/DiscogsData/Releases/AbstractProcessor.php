<?php
namespace WebServCo\DiscogsData\Releases;

abstract class AbstractProcessor extends \WebServCo\DiscogsData\AbstractDataProcessor
{
    public function getDataType()
    {
        return \WebServCo\DiscogsData\Data\Types::RELEASE;
    }
}
