<?php

namespace App\Http\Controllers;

use App\Enums\KeyType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Services\ApiService;
use App\Services\ActionService;
use App\Services\ApiKeyService;

class ApiKeyController extends Controller
{
    private $apiService;
    private $actionService;
    private $apiKeyService;

    public function __construct(
        ApiService $apiService,
        ActionService $actionService,
        ApiKeyService $apiKeyService
    )
    {
        $this->apiService = $apiService;
        $this->actionService = $actionService;
        $this->apiKeyService = $apiKeyService;
    }

    public function index(Request $request)
    {
        $apiKeyList = $this->apiService->getKeyWithInfo();

        return view('/admin/keys/key_index', [
            'items' => $apiKeyList
        ]);
    }

    public function createKey(Request $request)
    {
        $resources = $this->actionService->resourceWithPermission();
        if ($request->getMethod() === 'POST') {
            try {
                $apiKey = $request->input('api_key');
                $type = $request->input('key_type');
                $description = $request->input('description');
                $apiStatus = $request->input('status');

                $resourcePermissions = $this->actionService->processResourcePermission($resources, $request);
                $this->apiKeyService->createApiKeyWithPermission($apiKey, $description, $apiStatus, $resourcePermissions, $type);

                Session::flash('message', 'Api key was created successfully!');
            } catch (\Exception $e) {
                Session::flash('message', $e->getMessage());
            }

            return redirect()->route('admin.api.key.list');
        }

        return view('/admin/keys/key_create', [
            'resources' => $resources
        ]);
    }

    public function updateKey(Request $request)
    {
        $id = $request->query('id') ?? $request->input('id');
        $apiKeyRecord = $this->apiService->findById($id);
        $resources = $this->actionService->resourceWithPermission();
        $apiKeyPermissions = $this->apiKeyService->resourceWithPermission($id, KeyType::WEBSERVICE_KEY);

        if ($request->getMethod() === "POST") {
            try {
                $apiKey = $request->input('api_key');
                $type = $request->input('key_type');
                $description = $request->input('description');
                $keyStatus = $request->input('status');

                $resourcePermissions = $this->actionService->processResourcePermission($resources, $request);
                $this->apiKeyService->updateApiKeyWithPermission(
                    $apiKey,
                    $apiKeyRecord,
                    $description,
                    $keyStatus,
                    $resourcePermissions,
                    $apiKeyPermissions,
                    $type
                );

                Session::flash('message', 'Api key was updated successfully!');
            } catch (\Exception $e) {
                Session::flash('message', $e->getMessage());
            }

            return redirect()->route('admin.api.key.detail', ['id' => $id]);
        }


        $mergeResources = $this->apiKeyService->mergePermission($resources, $apiKeyPermissions);

        return view('/admin/keys/key_update', [
            'id' => $id,
            'key' => $apiKeyRecord,
            'resources' => $mergeResources
        ]);
    }

    public function viewKey(Request $request)
    {
        $id = $request->query('id');
        $apiKey = $this->apiService->findById($id);
        $resources = $this->actionService->resourceWithPermission();
        $apiKeyPermissions = $this->apiKeyService->resourceWithPermission($id, KeyType::WEBSERVICE_KEY);
        $mergeResources = $this->apiKeyService->mergePermission($resources, $apiKeyPermissions);

        return view('/admin/keys/key_detail', [
            'id' => $id,
            'key' => $apiKey,
            'resources' => $mergeResources
        ]);
    }
}
