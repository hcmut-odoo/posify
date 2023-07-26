<?php

namespace App\Exceptions;

use Exception;

class DuplicateEntryException extends Exception
{
    protected $code;

    public function __construct($message = 'Duplicate entry.', $code = 400)
    {
        parent::__construct($message);
        $this->code = $code;
    }
}
