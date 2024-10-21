<?php

use App\Models\Formation;
use App\Models\Teacher;
use Tests\DefaultFunctions;

it('test index of FormationController', function () {
    $token = DefaultFunctions::makeLogin();

    $response = $this->withHeaders(['authToken' => $token])
        ->getJson(route('formation.index'));

    $response->assertStatus(200);
});

it('test create of TeacherController', function () {
    $token = DefaultFunctions::makeLogin();

    $item = [
        'title' => fake()->title(),
        'description' => fake()->text(50),
    ];

    $response = $this->withHeaders(['authToken' => $token])
        ->postJson(route('formation.store'), $item);

    $response->assertStatus(200);
});

it('test update of FormationController', function () {
    $token = DefaultFunctions::makeLogin();

    $item = Formation::inRandomOrder()->first();

    $response = $this->withHeaders(['authToken' => $token])
        ->putJson(route('formation.update', $item->id), [
            'title' => fake()->title()
        ]);

    $response->assertStatus(200);
});

it('test delete of FormationController', function () {
    $token = DefaultFunctions::makeLogin();

    $item = Formation::factory()->create();

    $response = $this->withHeaders(['authToken' => $token])
        ->deleteJson(route('formation.destroy', $item->id));

    $response->assertStatus(200);
});
