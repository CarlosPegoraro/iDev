<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

use function Pest\Laravel\postJson;

it('validate the register system', function () {

    $email = Carbon::now();
    $email = (string) $email->isoFormat('hms');
    
    $response = postJson('/api/register', [
        'email' => $email .  '@gmail.com',
        'name' => 'test name',
        'password' => '123456789',
    ]);

    $data = $response->json();

    $response->assertStatus(200)
        ->assertJson([
            'token' => $data['token']
        ]);
});
