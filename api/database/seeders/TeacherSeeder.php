<?php

namespace Database\Seeders;

use App\Models\Teacher;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Teacher::create([
            'name' => 'Teacher 1',
            'document' => '123456789',
            'password' => Hash::make('123456789')
        ]);
        Teacher::create([
            'name' => 'Teacher 2',
            'document' => '987654321',
            'password' => Hash::make('123456789')
        ]);
    }
}
