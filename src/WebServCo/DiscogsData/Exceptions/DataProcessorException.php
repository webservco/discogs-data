<?php

declare(strict_types=1);

namespace WebServCo\DiscogsData\Exceptions;

class DataProcessorException extends DiscogsDataException
{
    public const CODE = 0;

    public function __construct(string $message, ?\Throwable $previous = null)
    {
        parent::__construct($message, self::CODE, $previous);
    }
}
