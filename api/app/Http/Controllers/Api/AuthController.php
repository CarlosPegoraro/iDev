<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\SessionToken;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
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
            $datetime = (string) new Carbon();
            $token = Hash::make($user->id . $datetime . $ip);
            $sessionToken = new SessionToken([
                'token' => $token,
                'ip_address' => $ip,
                'user_agent' => $userAgent,
                'remember' => $request->input('remember') ?? false,
            ]);

            $authToken = $user->sessionToken()->save($sessionToken);
            return response()->json([
                'user' => [
                    'name' => $user->name,
                    'id' => $user->id,
                ],
                'token' => $authToken->token,
            ]);
        }

        return response()->json(['error' => 'user not found'], 403);
    }

    public function logout(): JsonResponse
    {
        if (SessionToken::where('user_id', '=', Auth::user()->id)->delete()) {
            Auth::logout();
            return response()->json(['message' => 'Logout sucessful'], 200);
        } else {
            return response()->json(['message' => 'Error in Logout'],500);
        }
    }
}
