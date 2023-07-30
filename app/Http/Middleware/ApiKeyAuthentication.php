<?php

namespace App\Http\Middleware;

use Closure;
use App\Services\ApiService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Exceptions\HttpResponseException;

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
        if (empty($apiKey) || !validate_parameter($apiKey)) {
            throw new HttpResponseException(response()->json([
                'success'   => false,
                'message'   => 'API keyerrors',
                'data'      => 'API key is missing!'
            ]), 401);
        }

        $apiKeyRecord = $this->apiService->getByKey($apiKey);
        if (!$apiKeyRecord) {
            throw new HttpResponseException(response()->json([
                'success'   => false,
                'message'   => 'API keyerrors',
                'data'      => 'Invalid API key!'
            ]), 401);
        }

        $isExpired = $this->apiService->checkExpired($apiKey);
        if (!$isExpired) {
            throw new HttpResponseException(response()->json([
                'success'   => false,
                'message'   => 'API keyerrors',
                'data'      => 'API key was expired!'
            ]), 401);
        }

        $controller = class_basename(Route::current()->controller);
        $method = Route::current()->getActionMethod();

        $hasPermisstion = $this->apiService->checkPermission($apiKeyRecord, $controller, $method);

        if (!$hasPermisstion) {
            throw new HttpResponseException(response()->json([
                'success'   => false,
                'message'   => 'PI keyerrors',
                'data'      => 'API key was unauthorized!'
            ]), 403);
        }

        return $next($request);
    }
}
