<?php

namespace App\Exceptions;

use Exception;

class FileUploadException extends Exception
{
    public function __construct($message = 'File upload failed.')
    {
        parent::__construct($message);
    }
}
