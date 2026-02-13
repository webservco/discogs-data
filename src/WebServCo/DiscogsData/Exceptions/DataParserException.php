<?php

declare(strict_types=1);

namespace WebServCo\DiscogsData\Exceptions;

use Throwable;

final class DataParserException extends DiscogsDataException
{
    public const int CODE = 0;

    public function __construct(string $message, ?Throwable $previous = null)
    {
        parent::__construct($message, self::CODE, $previous);
    }
}
