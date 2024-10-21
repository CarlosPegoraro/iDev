<?php

use App\Models\Teacher;
use Tests\DefaultFunctions;

it('test index of TeacherController', function () {
    $token = DefaultFunctions::makeLogin();

    $response = $this->withHeaders(['authToken' => $token])
        ->getJson(route('teacher.index'));

    $response->assertStatus(200);
});

it('test create of TeacherController', function () {
    $token = DefaultFunctions::makeLogin();

    $item = (object) [
        'name' => fake()->name(),
        'document' => fake()->creditCardNumber(),
        'password' => fake()->password()
    ];

    $response = $this->withHeaders(['authToken' => $token])
        ->postJson(route('teacher.store'), [
            'name' => $item->name,
            'document' => $item->document,
            'password' => $item->password,
        ]);

    $response->assertStatus(200);
});

it('test update of TeacherController', function () {
    $token = DefaultFunctions::makeLogin();

    $item = Teacher::inRandomOrder()->first();

    $response = $this->withHeaders(['authToken' => $token])
        ->putJson(route('teacher.update', $item->id), [
            'name' => fake()->name()
        ]);

    $response->assertStatus(200);
});

it('test delete of TeacherController', function () {
    $token = DefaultFunctions::makeLogin();

    $item = Teacher::factory()->create();

    $response = $this->withHeaders(['authToken' => $token])
        ->deleteJson(route('teacher.destroy', $item->id));

    $response->assertStatus(200);
});
