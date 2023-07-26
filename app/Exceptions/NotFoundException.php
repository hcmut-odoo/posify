<?php

namespace App\Exceptions;

use Exception;

class NotFoundException extends Exception
{
    protected $code;

    public function __construct($message = 'Record not found.', $code = 404)
    {
        parent::__construct($message);
        $this->code = $code;
    }
}
