<?php

namespace App\Exceptions;

use Exception;

class UpdateFailedException extends Exception
{
    protected $code = 400;

    public function __construct($message = 'Failed to update the record.')
    {
        parent::__construct($message);
    }
}
