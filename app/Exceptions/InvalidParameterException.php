<?php

namespace App\Exceptions;

use Exception;

class InvalidParameterException extends Exception
{
    protected $code;

    public function __construct($message = 'Invalid parameter.', $code = 400)
    {
        parent::__construct($message);
        $this->code = $code;
    }
}
