<?php
namespace WebServCo\DiscogsData;

use \WebServCo\DiscogsData\Exceptions\ParserException;

final class Parser
{
    protected $xmlPath;
    protected $processItemCallable;

    public function __construct($xmlPath, $processItemCallable)
    {
        if (!is_readable($xmlPath)) {
            throw new ParserException(sprintf('XML path not readable: %s', $xmlPath));
        }
        if (!is_callable($processItemCallable)) {
            throw new ParserException('Callable not found');
        }

        $this->xmlPath = $xmlPath;
        $this->processItemCallable = $processItemCallable;
    }

    public function run()
    {
        $data = [
            'xmlPath' => $this->xmlPath,
        ];
        $args = [$data];
        call_user_func_array($this->processItemCallable, $args);
        return;
        //XXX
    }
}
