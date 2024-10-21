<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\SessionToken;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(LoginRequest $request): JsonResponse
    {
        $user = User::attempt([
            'email' => $request->input('email'),
            'password' => $request->input('password')
        ]);

        if ($user) {
            $authToken = $this->createSessionToken($user, $request);
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

    public function logout(Request $request): JsonResponse
    {
        $user = $request->attributes->get('userId');
        if (SessionToken::where('user_id', '=', $user)->delete()) {
            return response()->json(['message' => 'Logout sucessful'], 200);
        } else {
            return response()->json(['message' => 'Error in Logout'], 500);
        }
    }

    public function register(LoginRequest $request): JsonResponse
    {
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);

        if ($user) {
            $authToken = $this->createSessionToken($user, $request);
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

    private function createSessionToken(User $user, Request $request): SessionToken
    {
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

        return $user->sessionToken()->save($sessionToken);
    }
}
