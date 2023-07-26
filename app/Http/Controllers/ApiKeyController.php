<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

use App\Services\ApiService;
use Illuminate\Support\Facades\Session;

class ApiKeyController extends Controller
{
    private $apiService;

    public function __construct(ApiService $apiService)
    {
        $this->apiService = $apiService;
    }

    /**
     * Generate and assign an API key to the user.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function generateApiKey(Request $request)
    {
        $user = $request->user();

        if (!$user) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }

        $apiKey = User::generateApiKey();
        $user->api_key = $apiKey;
        $user->save();

        return response()->json(['api_key' => $apiKey]);
    }

    public function index(Request $request)
    {
        $apiKeyList = $this->apiService->getAll();

        return view('/admin/apis', [
            'apis' => $apiKeyList
        ]);
    }

    public function create(Request $request)
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

        return view('/admin/apis/create');
    }

    public function update(Request $request)
    {
        $apiKeyList = $this->apiService->getAll();

        return view('/admin/apis', [
            'apis' => $apiKeyList
        ]);
    }

    public function read(Request $request)
    {
        $apiKeyList = $this->apiService->getAll();

        return view('/admin/apis', [
            'apis' => $apiKeyList
        ]);
    }
}
