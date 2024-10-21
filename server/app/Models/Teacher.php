<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Collection;

class Teacher extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'document', 'phone', 'password', 'email', 'admin'];

    public static function apiData($data = null): Collection|array
    {
        $returnData = ['admin', 'document', 'email', 'name', 'phone'];
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

    public function course(): HasMany
    {
        return $this->hasMany(Course::class);
    }

    public function formations(): BelongsToMany
    {
        return $this->belongsToMany(Formation::class, 'formation_teacher');
    }
}
