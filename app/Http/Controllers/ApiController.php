<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Product;
use App\Models\Category;
use App\Models\User;
use App\Models\Store;

class ApiController extends Controller
{

    public function checkConnection(Request $request)
    {
        $apiKey = $request->header('X-API-Key');

        // Check if the API key is valid
        if ($apiKey) {
            return response()->json(['message' => 'Connection successful'], 200);
        } else {
            return response()->json(['message' => 'API key missing or invalid'], 400);
        }
    }

    public function resourceList(Request $request, string $modelClass)
    {
        // Retrieve the JSON payload from the request
        $data = $request->json()->all();

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

        // Return the resource list as JSON response
        return response()->json($resources);
    }

    public function products(Request $request)
    {
        return $this->resourceList($request, Product::class);
    }

    public function users(Request $request)
    {
        return $this->resourceList($request, User::class);
    }

    public function categories(Request $request)
    {
        return $this->resourceList($request, Category::class);
    }

    public function stores(Request $request)
    {
        return $this->resourceList($request, Store::class);
    }

    public function getProduct(Request $request, $id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['error' => 'Item not found'], 404);
        }
        return response()->json($product);
    }

    public function getCategory(Request $request, $id)
    {
        $category = Category::find($id);
        if (!$category) {
            return response()->json(['error' => 'Item not found'], 404);
        }
        return response()->json($category);
    }

    public function getUser(Request $request, $id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['error' => 'Item not found'], 404);
        }
        return response()->json($user);
    }

    public function getStore(Request $request, $id)
    {
        $store = Store::find($id);
        if (!$store) {
            return response()->json(['error' => 'Item not found'], 404);
        }
        return response()->json($store);
    }
}
