<?php

namespace Tests;

use App\Models\User;

use function Pest\Laravel\postJson;

class DefaultFunctions
{
    public static function makeLogin(): string
    {
        $response = postJson('/api/login', [
            'email' => 'test@example.com',
            'password' => '123456789',
        ]);

        $data = $response->json();
        return $data['token'];
    }
}
