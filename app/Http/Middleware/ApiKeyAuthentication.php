<?php

namespace App\Http\Middleware;

use App\Models\User;
use App\Services\ApiService;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class ApiKeyAuthentication
{
    private $apiService;

    public function __construct(ApiService $apiService)
    {
        $this->apiService = $apiService;
    }

    public function handle(Request $request, Closure $next)
    {
        $apiKey = $request->header('X-API-Key');
        if (empty($apiKey)) {
            return response()->json(['error' => 'API key is missing.'], 401);
        }

        $apiKeyRecord = $this->apiService->getByKey($apiKey);
        if (!$apiKeyRecord) {
            return response()->json(['error' => 'Invalid API key.'], 401);
        }

        $isExpired = $this->apiService->checkExpired($apiKey);
        if (!$isExpired) {
            return response()->json(['error' => 'API key was expired.'], 401);
        }

        $controller = class_basename(Route::current()->controller);
        $method = Route::current()->getActionMethod();

        $hasPermisstion = $this->apiService->checkPermission($apiKeyRecord, $controller, $method);

        if (!$hasPermisstion) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        return $next($request);
    }
}
