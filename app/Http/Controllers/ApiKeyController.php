<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Services\ApiService;
use App\Services\ActionService;

class ApiKeyController extends Controller
{
    private $apiService;
    private $actionService;

    public function __construct(ApiService $apiService, ActionService $actionService)
    {
        $this->apiService = $apiService;
        $this->actionService = $actionService;
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
        if ($request->getMethod() === 'POST') {
            $apiKey = $this->apiService->generate($request->user()->id);
            if ($apiKey) {
                Session::flash('createApiKeyMessage', 'Api key was created successfully!');
            } else {
                Session::flash('createApiKeyMessage', 'Failed to create api key.');
            }
            return redirect()->back();
        }

        $controllers = $this->actionService->getAll();
        $controllers = $this->actionService->convertToNestedArray($controllers);

        return view('/admin/keys/key_create', [
            'controllers' => $controllers
        ]);
    }

    public function updateKey(Request $request, $id)
    {
        $apiKeyList = $this->apiService->getAll();

        return view('/admin/keys/update', [
            'items' => $apiKeyList
        ]);
    }

    public function viewKey(Request $request, $id)
    {
        $apiKeyList = $this->apiService->findById($id);

        return view('/admin/keys/', [
            'items' => $apiKeyList
        ]);
    }
}
