<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $user = User::create($request->all());

        if (!$user) {
            return response()->json('User not created');
        }
        return response()->json('User created');
    }

    public function index(): JsonResponse
    {
        $users = User::apiData();
        return response()->json($users);
    }

    public function show(string $email): JsonResponse
    {
        $user = User::where('email', '=', $email)->first();
        $user = User::apiData($user);
        return response()->json($user);
    }

    public function update(Request $request, string $email): JsonResponse
    {
        $user = User::where('email', '=', $email)->first();
        $user->update($request->all());

        if (!$user) {
            return response()->json('User not deleted');
        }
        return response()->json('User deleted');
    }

    public function delete(string $email): JsonResponse
    {
        $user = User::where('email', '=', $email)->delete();

        if (!$user) {
            return response()->json('User not deleted');
        }
        return response()->json('User deleted');
    }
}
