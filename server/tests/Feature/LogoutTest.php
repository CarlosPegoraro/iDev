<?php

use App\Models\SessionToken;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

use function Pest\Laravel\postJson;

it('can logout a user', function () {
    
    $user = User::factory()->create([
        'password' => Hash::make('123456789')
    ]);

    $response = postJson('/api/login', [
        'email' => $user->email,
        'password' => '123456789',
        'remember' => true,
    ]);

    $data = $response->json();
    $token = $data['token'];

    $response = $this->withHeaders(['authToken' => $token])
        ->postJson(route('logout'));

    // Verificar a resposta
    $response->assertStatus(200)
        ->assertJson(['message' => 'Logout sucessful']);
});
