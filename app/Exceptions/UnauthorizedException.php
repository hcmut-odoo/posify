<?php

namespace App\Exceptions;

use Exception;

class UnauthorizedException extends Exception
{
    protected $code;

    public function __construct($message = 'Unauthorized.', $code = 403)
    {
        parent::__construct($message);
        $this->code = $code;
    }
}
