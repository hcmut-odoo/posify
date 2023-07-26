<?php

namespace App\Exceptions;

use Exception;

class DeleteFailedException extends Exception
{
    protected $code = 400;

    public function __construct($message = 'Failed to delete the record.')
    {
        parent::__construct($message);
    }
}
