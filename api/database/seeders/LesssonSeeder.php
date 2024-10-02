<?php

namespace Database\Seeders;

use App\Models\Lesson;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LesssonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Lesson::create([
            'title' => 'lession 1',
            'description' => 'description lession 1',
            'video' => 'test',
            'course_id' => 1
        ]);
    }
}
