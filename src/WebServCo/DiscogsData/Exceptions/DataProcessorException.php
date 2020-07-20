<?php
namespace WebServCo\DiscogsData\Exceptions;

class DataProcessorException extends DiscogsDataException
{
    const CODE = 0;

    public function __construct($message, \Exception $previous = null)
    {
        parent::__construct($message, self::CODE, $previous);
    }
}
