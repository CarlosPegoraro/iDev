<?php

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

use function Pest\Laravel\postJson;

it('validate the login system', function () {
    $user = User::factory()->create([
        'password' => Hash::make('123456789')
    ]);

    $response = postJson('/api/login', [
        'email' => $user->email,
        'password' => '123456789',
        'remember' => true,
    ]);
    
    $data = $response->json();

    $response->assertStatus(200)
        ->assertJson([
            'token' => $data['token']
        ]);
});
