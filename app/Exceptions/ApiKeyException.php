<?php

namespace App\Exceptions;

use Exception;

class ApiKeyException extends Exception
{
    protected $code = 400;

    public function __construct($message = 'An error occurred while creating the invoice.', $code = 403)
    {
        parent::__construct($message);
    }
}
