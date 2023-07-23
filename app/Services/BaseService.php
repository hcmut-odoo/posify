<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BaseService
{
    protected static $instance;

    public function __construct()
    {
        if (static::$instance === null) {
            static::$instance = $this;
            $this->startService();
        }
    }

    protected function startService()
    {
        DB::listen(function ($query) {
            $sql = $query->sql;
            $bindings = $query->bindings;
            $logQuery = vsprintf(str_replace('?', "'%s'", $sql), $bindings);
            Log::channel('db')->info($logQuery);
        });
    }
}
