<?php

namespace Khill\FontAwesome\Exceptions;

class InvalidTransformationClass extends \InvalidArgumentException
{
    public function __construct($class)
    {
        $message = $class . ' is not a valid transformation class.';

        parent::__construct($message);
    }
}
