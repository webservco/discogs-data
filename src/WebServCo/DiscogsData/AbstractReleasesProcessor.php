<?php
namespace WebServCo\DiscogsData;

abstract class AbstractReleasesProcessor extends AbstractDataProcessor
{
    public function getDataType()
    {
        return DataTypes::RELEASE;
    }
}
