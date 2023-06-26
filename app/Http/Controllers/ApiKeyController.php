<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ApiKeyController extends Controller
{
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
}
