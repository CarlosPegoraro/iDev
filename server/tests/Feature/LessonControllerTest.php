<?php

use App\Models\Course;
use App\Models\Formation;
use App\Models\Lesson;
use App\Models\Teacher;
use Tests\DefaultFunctions;

it('test index of LessonController', function () {
    $token = DefaultFunctions::makeLogin();

    $response = $this->withHeaders(['authToken' => $token])
        ->getJson(route('lesson.index'));

    $response->assertStatus(200);
});

it('test create of TeacherController', function () {
    $token = DefaultFunctions::makeLogin();

    $item = [
        'title' => fake()->title(),
        'description' => fake()->text(50),
        'video' => fake()->url(),
        'course_id' => Course::inRandomOrder()->first()->id
    ];

    $response = $this->withHeaders(['authToken' => $token])
        ->postJson(route('lesson.store'), $item);

    $response->assertStatus(200);
});

it('test update of LessonController', function () {
    $token = DefaultFunctions::makeLogin();

    $item = Lesson::inRandomOrder()->first();

    $response = $this->withHeaders(['authToken' => $token])
        ->putJson(route('lesson.update', $item->id), [
            'title' => fake()->title()
        ]);

    $response->assertStatus(200);
});

it('test delete of LessonController', function () {
    $token = DefaultFunctions::makeLogin();

    $item = Lesson::factory()->create();

    $response = $this->withHeaders(['authToken' => $token])
        ->deleteJson(route('lesson.destroy', $item->id));

    $response->assertStatus(200);
});

// numero 1 e numero 2
// ler os dois numeros
// criar o menu com 5 opcoes
// ler a opca do menu
// realizar o calculo baseado na opcao do menu
