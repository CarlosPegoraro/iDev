<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Course::create([
            'title' => 'Course 1',
            'description' => 'Course one',
            'teacher_id' => 1,
            'formation_id' => 1
        ]);
        Course::create([
            'title' => 'Course 1',
            'description' => 'Course one',
            'teacher_id' => 1,
        ]);
    }
}
