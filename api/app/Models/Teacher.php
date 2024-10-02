<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Teacher extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'document', 'phone', 'password', 'email', 'admin'];

    public function course(): HasMany
    {
        return $this->hasMany(Course::class);
    }

    public function formations(): BelongsToMany
    {
        return $this->belongsToMany(Formation::class, 'formation_teacher');
    }
}
