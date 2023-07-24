<?php

namespace App\Services;

use App\Repositories\ApiKeyRepository;
use App\Repositories\UserRoleRepository;
use App\Repositories\UserGroupRepository;
use App\Repositories\RoleGroupRepository;
use App\Repositories\ActionRepository;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class ApiKeyService extends BaseService
{
    private $apiKeyRepository;
    private $userRoleRepository;
    private $userGroupRepository;
    private $roleGroupRepository;
    private $actionRepository;

    public function __construct(
        ApiKeyRepository $apiKeyRepository,
        UserRoleRepository $userRoleRepository,
        UserGroupRepository $userGroupRepository,
        RoleGroupRepository $roleGroupRepository,
        ActionRepository $actionRepository
    )
    {
        $this->apiKeyRepository = $apiKeyRepository;
        $this->userRoleRepository = $userRoleRepository;
        $this->userGroupRepository = $userGroupRepository;
        $this->roleGroupRepository = $roleGroupRepository;
        $this->actionRepository = $actionRepository;
        parent::__construct();
    }

    public function getAll()
    {
        return $this->apiKeyRepository->getAll();
    }

    public function getById($id)
    {
        return $this->apiKeyRepository->get($id);
    }

    public function getByKey($key)
    {
        return $this->apiKeyRepository->getByKey($key);
    }

    public function checkExpired($key)
    {
        $apiKeyRecord = $this->apiKeyRepository->getByKey($key);
        return $apiKeyRecord->expired_at <= Carbon::now();
    }

    public function getValidActionList($key)
    {
        $actions = DB::table('api_keys')
            ->select('api_keys.user_id')
            ->where('api_keys.key', '=', $key)
            ->join('user_roles', 'user_roles.user_id', '=', 'api_keys.user_id')
            ->join('role_groups', 'user_roles.user_group_id', '=', 'role_groups.user_group_id')
            ->get()
            ->toArray();

        return $actions;
    }

    public function checkAdmin($key)
    {
        $userGroup = DB::table('api_keys')
            ->select('api_keys.user_id')
            ->where('api_keys.key', '=', $key)
            ->join('user_roles', 'user_roles.user_id', '=', 'api_keys.user_id')
            ->join('user_groups', 'user_roles.user_group_id', '=', 'user_groups.id')
            ->first();

        return $userGroup->permission === "admin";
    }

    public function checkPermission($apiKey, $controller, $action)
    {
        $userRole = $this->userRoleRepository->get($apiKey->user_id);
        $userGroup = $this->userGroupRepository->get($userRole->group_id);
        if ($userGroup->permission === "admin") {
            return true;
        }
        $actionIds = $this->roleGroupRepository->getByGroupId($userRole->group_id);
        $actionId = $this->actionRepository->search([
            'controller' => $controller,
            'method' => $action
        ], ['id']);

        return in_array($actionId, $actionIds);
    }

    public function generate($userId)
    {
        return $this->apiKeyRepository->create(Str::random(32), $userId);
    }
}
