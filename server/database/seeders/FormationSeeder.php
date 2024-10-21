<?php

namespace Database\Seeders;

use App\Models\Formation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FormationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Formation::create([
            'title' => 'Formation 1',
            'description' => 'description one',
        ]);
        Formation::create([
            'title' => 'Formation 2',
            'description' => 'description two',
        ]);
    }
}
