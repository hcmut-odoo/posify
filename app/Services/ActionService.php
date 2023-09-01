<?php

namespace App\Services;

use App\Repositories\ActionRepository;
use App\Repositories\PermissionRepository;
use App\Repositories\ResourceRepository;

class ActionService extends BaseService
{
    private $actionRepository;
    private $resourceRepository;
    private $permissionRepository;

    public function __construct(
        ActionRepository $actionRepository,
        ResourceRepository $resourceRepository,
        PermissionRepository $permissionRepository
    )
    {
        $this->actionRepository = $actionRepository;
        $this->resourceRepository = $resourceRepository;
        $this->permissionRepository = $permissionRepository;
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

    public function resourceWithPermission()
    {
        $resources = $this->resourceRepository->getAll();
        $perrmisions = $this->permissionRepository->getAll();
        $mixedArray = [];

        foreach ($resources as $resource) {
            $resourceMixPermission = [
                'resource_id' => $resource->id,
                'resource' => $resource->name
            ];

            foreach ($perrmisions as $perrmision) {
                $resourceMixPermission['permissions'][] = [
                    'permission_id' => $perrmision->id,
                    'permission' => $perrmision->name
                ];
            }

            $mixedArray[] = $resourceMixPermission;
        }

        return $mixedArray;
    }

    public function processResourcePermission($resources, $request)
    {
        $resourcePermissions = [];

        foreach ($resources as $resource) {
            foreach ($resource['permissions'] as $permission) {
                $checkboxName = $resource['resource'] . '_' . $permission['permission'];
                if ($request->input($checkboxName)) {
                    $resourcePermissions[$resource['resource']][] = $permission['permission_id'];
                }
            }
        }

        return $resourcePermissions;
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
        ], $fields)->first();
    }
}
