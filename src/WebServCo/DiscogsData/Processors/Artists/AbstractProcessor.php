<?php

declare(strict_types=1);

namespace WebServCo\DiscogsData\Processors\Artists;

use WebServCo\DiscogsData\Data\Types;
use WebServCo\DiscogsData\Processors\AbstractDataProcessor;

abstract class AbstractProcessor extends AbstractDataProcessor
{
    public const string DATA_TYPE = Types::ARTIST;
}
