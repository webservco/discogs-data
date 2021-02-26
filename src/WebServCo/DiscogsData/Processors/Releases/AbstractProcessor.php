<?php

declare(strict_types=1);

namespace WebServCo\DiscogsData\Processors\Releases;

abstract class AbstractProcessor extends \WebServCo\DiscogsData\Processors\AbstractDataProcessor
{
    const DATA_TYPE = \WebServCo\DiscogsData\Data\Types::RELEASE;
}
