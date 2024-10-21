<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

class Formation extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description'];

    public static function apiData($data = null): Collection|array
    {
        $returnData = ['title', 'description'];
        if ($data) {
            $teachers = [];
            foreach ($data as $teacher) {
                $teachers[] = $teacher->only($returnData);
            }
        } else {
            $teachers = self::all()->pluck($returnData);
        }
        return $teachers;
    }


    public function teachers(): BelongsToMany
    {
        return $this->belongsToMany(Teacher::class, 'formation_teacher');
    }

    public function courses(): HasMany
    {
        return $this->hasMany(Course::class);
    }
}
