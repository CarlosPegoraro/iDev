<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;

use function Pest\Laravel\postJson;

it('validate the login system', function () {
    $user = User::factory()->create([
        'password' => Hash::make('123456789')
    ]);

    $response = postJson('api/login', [
        'email' => $user->email,
        'password' => '123456789',
        'remember' => true,
    ]);

    $response->assertStatus(201)
        ->assertJson([
            'message' => 'User created successfully!',
        ]);
});
