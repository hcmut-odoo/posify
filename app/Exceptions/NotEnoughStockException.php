<?php

namespace App\Exceptions;

use Exception;

class NotEnoughStockException extends Exception
{
    protected $code = 400;

    public function __construct($message = 'Insufficient stock for product variant.')
    {
        parent::__construct($message);
    }
}
