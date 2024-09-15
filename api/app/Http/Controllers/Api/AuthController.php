<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(LoginRequest $request): JsonResponse
    {
        Auth::attempt([
            'email' => $request->input('email'),
            'password' => $request->input('password')
        ]);

        if ($user = Auth::user()) {
            $userAgent = $request->header('User-Agent');
            $ip = $request->header('host');
            $datetime = new Carbon();
            $token = Hash::make($user->id . $datetime . $ip);
            $authToken = $user->seassionToken->create([
                'token' => $token,
                'ip_address' => $ip,
                'user_agent' => $userAgent
            ]);
            return redirect()->json([
                'user' => [
                    'name' => $user->name,
                    'id' => $user->id,
                ],
                'token' => $authToken->token,
            ]);
        }
    }
}
