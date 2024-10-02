<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('formation_teacher', function (Blueprint $table) {
            $table->foreignId('formation_id')->constrained();
            $table->foreignId('teacher_id')->constrained();
            $table->primary(['formation_id', 'teacher_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('formation_teacher');
    }
};
