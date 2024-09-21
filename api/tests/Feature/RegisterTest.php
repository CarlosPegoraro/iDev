<?php

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

use function Pest\Laravel\postJson;

it('validate the login system', function () {

    $response = postJson('/api/register', [
        'email' => 'email@email.com',
        'name' => 'testeTeste',
        'password' => '123456789',
    ]);

    $data = $response->json();

    $response->assertStatus(200)
        ->assertJson([
            'token' => $data['token']
        ]);
});
