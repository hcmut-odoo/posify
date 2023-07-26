<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Route;

class RouteAction extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'route:action';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'List all the controller actions in the application.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(Route $router)
    {
        $routes = app('router')->getRoutes();

        $this->info('List of Controller Actions:');
        foreach ($routes as $route) {
            $action = $route->getAction('controller');
            if ($action) {
                $this->line($action);
            }
        }
    }
}
