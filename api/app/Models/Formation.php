<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Formation extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description'];

    public function teachers(): BelongsToMany
    {
        return $this->belongsToMany(Teacher::class, 'formation_teacher');
    }

    public function courses(): HasMany
    {
        return $this->hasMany(Course::class);
    }
}
