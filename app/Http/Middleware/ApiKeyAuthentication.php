<?php

namespace App\Http\Middleware;

use App\Exceptions\ApiKeyException;
use Closure;
use App\Services\ApiKeyService;
use App\Services\ApiService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Exceptions\HttpResponseException;

class ApiKeyAuthentication
{
    private $apiService;
    private $apiKeyService;

    public function __construct(ApiService $apiService, ApiKeyService $apiKeyService)
    {
        $this->apiService = $apiService;
        $this->apiKeyService = $apiKeyService;
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

        try {
            $apiKeyRecord = $this->apiService->getByKey($apiKey);
        } catch (\Exception $e) {
            throw new HttpResponseException(response()->json([
                'success'   => false,
                'message'   => 'API keyerrors',
                'data'      => 'Invalid API key!'
            ]), 401);
        }

        try {
            $this->apiService->checkExpired($apiKey);
        } catch (\Exception $e) {
            throw new HttpResponseException(response()->json([
                'success'   => false,
                'message'   => 'API keyerrors',
                'data'      => 'API key was expired!'
            ]), 401);
        }

        try {
            $controller = class_basename(Route::current()->controller);
            $method = Route::current()->getActionMethod();
            $hasPermission = $this->apiKeyService->checkPermission($apiKeyRecord, $controller, $method);

            if (!$hasPermission) {
                throw new ApiKeyException('API key was unauthorized!', 403);
            }
        } catch (\Exception $e) {
            $errorResponse = [
                'success' => false,
                'message' => 'API key errors',
                'data'    => $e->getMessage()
            ];

            throw new HttpResponseException(response()->json($errorResponse), $e->getCode());
        }

        return $next($request);
    }
}
