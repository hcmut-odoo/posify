<?php

namespace App\Services;

use App\Enums\KeyType;
use App\Exceptions\ApiKeyException;
use App\Exceptions\InvalidParameterException;
use App\Exceptions\NotFoundException;
use App\Repositories\ApiKeyRepository;
use App\Repositories\PermissionActionGroupRepository;
use App\Repositories\UserAccessKeyRepository;
use App\Repositories\WebServiceKeyRepository;
use App\Repositories\ResourceRepository;
use App\Repositories\ActionRepository;
use Illuminate\Support\Facades\DB;

class ApiKeyService extends BaseService
{
    private $webServiceKeyRepository;
    private $userAccessKeyRepository;
    private $permissionActionGroupRepository;
    private $apiKeyRepository;
    private $actionRepository;
    private $resourceRepository;

    public function __construct(
        WebServiceKeyRepository $webServiceKeyRepository,
        UserAccessKeyRepository $userAccessKeyRepository,
        PermissionActionGroupRepository $permissionActionGroupRepository,
        ApiKeyRepository $apiKeyRepository,
        ActionRepository $actionRepository,
        ResourceRepository $resourceRepository
    )
    {
        $this->webServiceKeyRepository = $webServiceKeyRepository;
        $this->userAccessKeyRepository = $userAccessKeyRepository;
        $this->permissionActionGroupRepository = $permissionActionGroupRepository;
        $this->apiKeyRepository = $apiKeyRepository;
        $this->actionRepository = $actionRepository;
        $this->resourceRepository = $resourceRepository;
        parent::__construct();
    }

    public function createApiKeyWithPermission($apiKey, $description, $status, $resourcePermissions, $type)
    {
        if ($type === KeyType::WEBSERVICE_KEY) {
            try {
                DB::beginTransaction();

                $resources = array_keys($resourcePermissions);
                $apiKeyRecord = $this->apiKeyRepository->create($apiKey, $description, $status);
                $webServiceKeyRecord = $this->webServiceKeyRepository->create($apiKeyRecord->id);

                foreach ($resources as $resource) {
                    $resourceRecord = $this->resourceRepository->findByName($resource);
                    $actionList = $this->actionRepository->findByResourceId($resourceRecord->id);

                    foreach ($actionList as $actionElement) {
                        foreach ($resourcePermissions[$resource] as $permissionId) {
                            if ($actionElement["permission_id"] === $permissionId) {
                                $this->permissionActionGroupRepository->create(
                                    $actionElement["id"],
                                    $webServiceKeyRecord->id
                                );
                            }
                        }
                    }
                }

                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();
                throw new ApiKeyException($e->getMessage());
            }
        }
    }

    public function updateApiKeyWithPermission($apiKey, $apiKeyRecord, $description, $status, $resourcePermissions, $apiKeyPermissions, $type)
    {
        if ($type === KeyType::WEBSERVICE_KEY) {
            try {
                DB::beginTransaction();

                $resources = array_keys($resourcePermissions);

                // Update new value of apikey
                $apiKeyRecord->value = $apiKey;
                $apiKeyRecord->description = $description;
                $apiKeyRecord->status = $status;

                // Save
                $apiKeyRecord->save();

                $webServiceKeyRecord = $this->webServiceKeyRepository->findByApiKeyId($apiKeyRecord->id);

                $currentPermissions = [];
                $updatePermissions = [];

                foreach ($resources as $resource) {
                    $resourceRecord = $this->resourceRepository->findByName($resource);
                    $actionList = $this->actionRepository->findByResourceId($resourceRecord->id);

                    // Collect update permission as list action id 
                    foreach ($actionList as $actionElement) {
                        foreach ($resourcePermissions[$resource] as $updatePermissionId) {
                            if ($actionElement["permission_id"] === $updatePermissionId) {
                                $updatePermissions[] = $actionElement["id"];
                            }
                        }
                    }

                }

                // Collect current permission as list action id 
                foreach ($apiKeyPermissions as $apiKeyPermission) {
                    $actionRecords = $this->actionRepository->search([
                        'resource_id' => $apiKeyPermission["resource_id"],
                        'permission_id' => $apiKeyPermission["permission_id"]
                    ] ,['*']);

                    foreach ($actionRecords as $actionRecord) {
                        $actionId = $actionRecord->id;
                        if (!in_array($actionId, $currentPermissions)) {
                            $currentPermissions[] = $actionId;
                        }
                    }
                }

                // Diff check between current permissions and update permissions
                $needToAddPermissions = array_diff($updatePermissions, $currentPermissions);
                $needToRemovePermissions = array_diff($currentPermissions, $updatePermissions);

                foreach ($needToAddPermissions as $needToAddPermission) {
                    $existedPermission = $this->permissionActionGroupRepository
                        ->findByActionIdAndWebServiceKeyId($needToAddPermission, $webServiceKeyRecord->id);
                    if (!$existedPermission) {
                        $this->permissionActionGroupRepository->create(
                            $needToAddPermission,
                            $webServiceKeyRecord->id
                        );
                    }
                }
                
                // Remove exist permission
                foreach ($needToRemovePermissions as $needToRemovePermissionId) {
                    $existedPermission = $this->permissionActionGroupRepository
                        ->findByActionIdAndWebServiceKeyId($needToRemovePermissionId, $webServiceKeyRecord->id);
                    if ($existedPermission) {
                        $this->permissionActionGroupRepository->remove($existedPermission->id);
                    }
                }

                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();
                throw new ApiKeyException($e->getMessage());
            }
        }
    }

    public function checkDifferentPermission($currentPermissions, $updatePermissionId)
    {
        foreach ($currentPermissions as $currentPermission) {
            if ($currentPermission["permission_id"] === $updatePermissionId) {
                return false;
            }    
        }

        return true;
    }

    public function checkPermission($apiKeyRecord, $controller, $method)
    {
        $webServiceKeyRecord = $this->webServiceKeyRepository->findByApiKeyId($apiKeyRecord->id);

        if ($webServiceKeyRecord) {
            $actionList = $this->permissionActionGroupRepository->getActionIdsByWebserviceKeyId($webServiceKeyRecord->id);
            $actionRecord = $this->actionRepository->search([
                'controller' => $controller,
                'method' => $method
            ], ['*'])->first();
            
            if (!$actionRecord) {
                throw new NotFoundException("Record action has controller {$controller} and method {$method} not found");
            }

            $actionId = $actionRecord->id;
            foreach ($actionList as $actionElement) {
                if ($actionElement["action_id"] == $actionId) {
                    return true;
                }
            }
        }
        
        return false;
    }

    public function findById($id)
    {
        if (!validate_id($id)) {
            throw new InvalidParameterException("Invalid api key ID: $id");
        }
        $apiKey = $this->apiKeyRepository->get($id);
        if (!$apiKey) {
            throw new NotFoundException("Record api key has ID $id not found");
        }
        return $apiKey;
    }

    public function resourceWithPermission($id, $type)
    {
        if (!validate_id($id)) {
            throw new InvalidParameterException("Invalid api key ID: $id");
        }

        if ($type === KeyType::WEBSERVICE_KEY) {
            $webServiceKeyRecord = $this->webServiceKeyRepository->findByApiKeyId($id);
            $permissionActionList = $this->permissionActionGroupRepository->getActionIdsByWebserviceKeyId($webServiceKeyRecord->id);
        }

        $mixedArray = [];
        foreach ($permissionActionList as $permissionActionElement) {
            $actionRecord = $this->actionRepository->get($permissionActionElement["action_id"]);

            $resourcePermissions = [
                'resource_id' => $actionRecord->resource_id,
                'permission_id' => $actionRecord->permission_id
            ];

            $mixedArray[] = $resourcePermissions;
        }

        return $mixedArray;
    }

    public function mergePermission(&$allResourcePermissions, $actualResourcePermissions)
    {
        foreach ($actualResourcePermissions as $actualResourcePermission) {
            foreach ($allResourcePermissions as &$allResourcePermission) {
                if ($actualResourcePermission["resource_id"] === $allResourcePermission["resource_id"]) {
                    foreach ($allResourcePermission["permissions"] as &$permission) {
                        if ($actualResourcePermission["permission_id"] === $permission["permission_id"]) {
                            $permission["active"] = true;
                        }
                    }
                }
            }
        }

        // Unset the reference to avoid unintended modification later
        unset($permission);
        unset($allResourcePermission); 

        return $allResourcePermissions;
    }

}
