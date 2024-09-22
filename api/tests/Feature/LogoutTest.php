<?php

use App\Models\SessionToken;
use App\Models\User;

use function Pest\Laravel\postJson;

it('can logout a user', function () {
    // 1. Criar um usuário fake e um token de sessão
    $user = User::factory()->create();
    $token = SessionToken::factory()->create([
        'user_id' => $user->id,
    ]);

    // 2. Simular o usuário autenticado (usando o token)
    $this->withHeaders(['Authorization' => 'Bearer ' . $token->token])
         ->postJson(route('logout'));

    // 3. Verificar se o token foi excluído
    $this->assertDatabaseMissing('session_tokens', [
        'user_id' => $user->id,
    ]);

    // Verificar a resposta
    $response->assertStatus(200)
             ->assertJson(['message' => 'Logout sucessful']);
});
