<?php

declare(strict_types=1);

namespace WebServCo\DiscogsData\Processors\Artists;

abstract class AbstractProcessor extends \WebServCo\DiscogsData\Processors\AbstractDataProcessor
{
    public const DATA_TYPE = \WebServCo\DiscogsData\Data\Types::ARTIST;
}
