<?php

declare(strict_types=1);

namespace WebServCo\DiscogsData\Exceptions;

class DiscogsDataException extends \Exception
{
    const CODE = 500;

    public function __construct($message, $code = self::CODE, ?\Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    public function __toString()
    {
        return \sprintf("%s: [%s]: %s\n", self::class, $this->code, $this->message);
    }
}
