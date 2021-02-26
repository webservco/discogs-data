<?php

declare(strict_types=1);

namespace WebServCo\DiscogsData\Exceptions;

class DataValidationException extends DiscogsDataException
{
    const CODE = 0;

    public function __construct($message, ?\Throwable $previous = null)
    {
        parent::__construct($message, self::CODE, $previous);
    }
}
