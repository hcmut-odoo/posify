<?php

namespace App\Services;

use App\Repositories\ActionRepository;

class ActionService extends BaseService
{
    private $actionRepository;

    public function __construct(ActionRepository $actionRepository)
    {
        $this->actionRepository = $actionRepository;
        parent::__construct();
    }

    public function getAll()
    {
        return $this->actionRepository->getAll();
    }

    public function findById($id)
    {
        return $this->actionRepository->get($id);
    }

    public function convertToNestedArray($controllers)
    {
        $mergedControllers = [];
        foreach ($controllers as $controller) {
            $controllerName = $controller['controller'];
            $action = $controller['method'];

            if (array_key_exists($controllerName, $mergedControllers)) {
                $mergedControllers[$controllerName]['method'][] = $action;
            } else {
                $mergedControllers[$controllerName] = ['controller' => $controllerName, 'method' => [$action]];
            }
        }

        $controllers = array_values($mergedControllers);
        return $controllers;
    }

    public function search($controller, $method, $fields)
    {
        return $this->actionRepository->search([
            'controller' => $controller,
            'method' => $method
        ], $fields);
    }
}
