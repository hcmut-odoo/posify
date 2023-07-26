<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Repositories\ApiKeyRepository;
use App\Repositories\UserRoleRepository;
use App\Repositories\UserGroupRepository;
use App\Repositories\RoleGroupRepository;
use App\Repositories\ActionRepository;
use App\Exceptions\InvalidApiKeyException;

class ApiService extends BaseService
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

    public function findById($id)
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

    public function query($data, string $modelClass)
    {
        // Extract the parameters from the payload
        $filters = $data['filter'] ?? [];
        $display = $data['display'] ?? [];
        $sort = $data['sort'] ?? [];
        $date = $data['date'] ?? [];
        $limit = $data['limit'] ?? 10;
        $page = $data['page'] ?? 1;

        // Query the resource based on the filters
        $query = $modelClass::query();

        // Apply filters
        foreach ($filters as $field => $filter) {
            $operator = $filter['operator'];
            $value = $filter['value'];

            if ($operator === 'eq') {
                $query->where($field, $value);
            } elseif ($operator === 'like') {
                $query->where($field, 'like', "%$value%");
            } elseif ($operator === 'lt') {
                $query->where($field, '<', $value);
            } elseif ($operator === 'lteq') {
                $query->where($field, '<=', $value);
            } elseif ($operator === 'gt') {
                $query->where($field, '.', $value);
            } elseif ($operator === 'gteq') {
                $query->where($field, '>=', $value);
            } elseif ($operator === 'neq') {
                $query->where($field, '!=', $value);
            }
        }

        // Apply date range
        if ($date) {
            if ($date['start']) {
                $start = Carbon::parse($date['start']);
                $query->where('updated_at', '>=', $start);
            }
            if ($date['end']) {
                $end = Carbon::parse($date['end']);
                $query->where('updated_at', '<=', $end);
            }
        }

        // Selected fields
        if ($display && count($display) > 0) {
            if (!in_array('id', $display)) {
                array_unshift($display, 'id');
            }
            $query->select($display);
        }

        // Apply sorting
        foreach ($sort as $field => $order) {
            $query->orderBy($field, $order);
        }

        // Apply pagination
        $query->limit($limit)->offset(($page - 1) * $limit);

        // Retrieve the resources
        $resources = $query->get();

        return $resources;
    }

    public function checkConnection($apiKey)
    {
        if ($apiKey) {
            return true;
        } else {
            throw new InvalidApiKeyException();
        }
    }
}
