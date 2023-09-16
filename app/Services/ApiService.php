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
use App\Exceptions\InvalidParameterException;
use App\Exceptions\NotFoundException;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Log;

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

    public function getKeyWithInfo()
    {
        $webServiceKeys = DB::table('api_keys')
            ->join('web_service_keys', 'web_service_keys.api_key_id', '=', 'api_keys.id')
            ->select('api_keys.id', 'api_keys.value', 'api_keys.created_at', 'api_keys.status', 'api_keys.description')
            ->get();

        $userAccessKey = DB::table('api_keys')
            ->join('user_access_keys', 'user_access_keys.api_key_id', '=', 'api_keys.id')
            ->select('api_keys.id', 'api_keys.value', 'api_keys.created_at', 'api_keys.status', 'api_keys.description')
            ->get();

        return $webServiceKeys->concat($userAccessKey);
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

    public function getByKey($key)
    {
        if (!validate_parameter($key)) {
            throw new InvalidParameterException("Invalid api key ID: $key");
        }
        $apiKey = $this->apiKeyRepository->getByKey($key);
        if (!$apiKey) {
            throw new NotFoundException("Record api key has key $key not found");
        }

        return $apiKey;
    }

    public function checkExpired($key)
    {
        if (!validate_parameter($key)) {
            throw new InvalidParameterException("Invalid api key ID: $key");
        }
        $apiKey = $this->apiKeyRepository->getByKey($key);
        if (!$apiKey) {
            throw new NotFoundException("Record api key has key $key not found");
        }

        return $apiKey->expired_at <= Carbon::now();
    }

    public function getValidActionList($key)
    {
        if (!validate_parameter($key)) {
            throw new InvalidParameterException("Invalid api key ID: $key");
        }
        if (!$this->apiKeyRepository->getByKey($key)) {
            throw new NotFoundException("Record api key has key $key not found");
        }
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
        if (!validate_parameter($key)) {
            throw new InvalidParameterException("Invalid api key ID: $key");
        }
        if (!$this->apiKeyRepository->getByKey($key)) {
            throw new NotFoundException("Record api key has key $key not found");
        }
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
        ], ['id'])->first();

        return in_array($actionId, $actionIds);
    }

    public function generate($userId)
    {
        if (!validate_id($userId)) {
            throw new InvalidParameterException("Invalid user ID: $userId");
        }
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

        if ($modelClass === Product::class) {
            // If the modelClass is "Product," add variants to the query
            $query->with('variants');
        } elseif ($modelClass === Order::class) {
            // If the modelClass is "Order," add orderRows to the query
            $query->join('order_items', 'order_items.order_id', '=', 'orders.id')
                ->join('cart_items', 'order_items.cart_item_id', '=', 'cart_items.id')
                ->join('products', 'products.id', '=', 'cart_items.product_id')
                ->join('product_variants', 'product_variants.id', '=', 'cart_items.product_variant_id')
                ->join('payment_modes', 'payment_modes.id', '=', 'orders.payment_mode_id')
                ->select(
                    'order_items.*',
                    'cart_items.*',
                    'products.*',
                    'product_variants.*',
                    'orders.*',
                    'payment_modes.name AS payment_mode',
                    'payment_modes.id AS payment_mode_id',
                    'order_items.id AS order_item_id',
                );
        }

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
                $query->where($field, '>', $value);
            } elseif ($operator === 'gteq') {
                $query->where($field, '>=', $value);
            } elseif ($operator === 'neq') {
                $query->where($field, '!=', $value);
            }
        }

        // Apply date range
        if ($date) {
            if (isset($date['start']) && $date['start']) {
                $start = Carbon::parse($date['start']);
                $query->where('updated_at', '>=', $start);
            }
            if (isset($date['end']) && $date['end']) {
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

        // Count total record
        $total = $query->count();

        // Apply pagination
        $query->limit($limit)->offset(($page - 1) * $limit);

        // Retrieve the resources
        $resources = $query->get()->toArray();

        // Format resource
        if ($modelClass === Order::class) {
            $resources = $this->formatOrderResources($resources);
        }

        // Collect pagination data
        $pagination['page'] = $page;
        $pagination['limit'] = $limit;
        $pagination['total'] = $total;
        $pagination['next_page'] = $total > $page * $limit ? true : false;
        $pagination['prev_page'] = $page > 1;

        $mixed['data'] = $resources;
        $mixed['pagination'] = $pagination;

        return $mixed;
    }

    public function search($data, string $modelClass)
    {
        // Extract the parameters from the payload
        $filters = $data['filter'] ?? [];
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
                $query->where($field, '>', $value);
            } elseif ($operator === 'gteq') {
                $query->where($field, '>=', $value);
            } elseif ($operator === 'neq') {
                $query->where($field, '!=', $value);
            }
        }

        // Apply date range
        if ($date) {
            if (isset($date['start']) && $date['start']) {
                $start = Carbon::parse($date['start']);
                $query->where('updated_at', '>=', $start);
            }
            if (isset($date['end']) && $date['end']) {
                $end = Carbon::parse($date['end']);
                $query->where('updated_at', '<=', $end);
            }
        }

        // Selected only id
        $query->select(['id']);

        // Apply sorting
        foreach ($sort as $field => $order) {
            $query->orderBy($field, $order);
        }

        // Count total record
        $total = $query->count();

        // Apply pagination
        $query->limit($limit)->offset(($page - 1) * $limit);

        // Retrieve the resources
        $resources = $query->get()->toArray();

        // Collect pagination data
        $pagination['page'] = $page;
        $pagination['limit'] = $limit;
        $pagination['total'] = $total;
        $pagination['next_page'] = $total > $page * $limit ? true : false;
        $pagination['prev_page'] = $page > 1;

        $mixed['data'] = $resources;
        $mixed['pagination'] = $pagination;

        return $mixed;
    }

    public function checkConnection($apiKey)
    {
        if ($apiKey) {
            return true;
        } else {
            throw new InvalidApiKeyException();
        }
    }

    public function formatOrderResources($resources)
    {
        $output = [];

        foreach ($resources as $row) {
            $order = [
                "id" => $row["order_id"],
                "user_id" => $row["user_id"],
                "status" => $row["status"],
                "order_transaction" => $row["order_transaction"],
                "delivery_note" => $row["delivery_note"],
                "delivery_phone" => $row["delivery_phone"],
                "delivery_address" => $row["delivery_address"],
                "delivery_name" => $row["delivery_name"],
                "total" => $row["total"],
                "deleted_at" => $row["deleted_at"],
                "created_at" => $row["created_at"],
                "updated_at" => $row["updated_at"],
                "payment_mode_id" => $row["payment_mode_id"],
            ];

            $orderRows = [
                "id" => $row["order_item_id"],
                "quantity" => $row["quantity"],
                "product" => [
                    "id" => $row["product_id"],
                    "variant_id" => $row["product_variant_id"],
                    "price" => $row["price"],
                    "description" => $row["description"],
                    "name" => $row["name"],
                    "variant" => [
                        "id" => $row["product_variant_id"],
                        "product_id" => $row["product_id"],
                        "extend_price" => $row["extend_price"],
                        "size" => $row["size"],
                    ],
                ],
                "delivery" => [
                    "delivery_note" => $row["delivery_note"],
                    "delivery_phone" => $row["delivery_phone"],
                    "delivery_address" => $row["delivery_address"],
                    "delivery_name" => $row["delivery_name"],
                ],
                "user" => [
                    "id" => $row["user_id"],
                ],
                "payment" => [
                    "id" => $row["payment_mode_id"],
                    "name" => $row["payment_mode"],
                ],
            ];

            // Add the orderRows to the order
            $order["order_rows"] = [$orderRows];

            // Append the order to the output array
            $output[] = $order;
        }

        return $output;
    }
}
