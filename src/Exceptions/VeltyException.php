<?php
namespace Velty\Exceptions;

class VeltyException extends \Exception
{
    public string $solution = '';

    public function __construct(string $message, string $solution = '', int $code = 0)
    {
        $this->solution = $solution;
        parent::__construct($message, $code);
    }
}
