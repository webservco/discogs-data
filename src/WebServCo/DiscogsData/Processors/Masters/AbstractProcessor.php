<?php

declare(strict_types=1);

namespace WebServCo\DiscogsData\Processors\Masters;

abstract class AbstractProcessor extends \WebServCo\DiscogsData\Processors\AbstractDataProcessor
{
    protected const DATA_TYPE = \WebServCo\DiscogsData\Data\Types::MASTER;
}
