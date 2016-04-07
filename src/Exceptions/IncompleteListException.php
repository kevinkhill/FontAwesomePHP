<?php namespace Khill\Fontawesome\Exceptions;

class IncompleteListException extends \Exception
{
    public function __construct($message, $code = 2, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    public function __toString()
    {
        return __CLASS__ . ": [ERROR] {$this->message}\n";
    }

}
