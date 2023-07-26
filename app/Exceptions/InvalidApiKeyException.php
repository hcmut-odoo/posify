<?php

namespace App\Exceptions;

use Exception;

class InvalidApiKeyException extends Exception
{
    protected $code = 400;

    public function __construct($message = 'API key missing or invalid')
    {
        parent::__construct($message);
    }
}
