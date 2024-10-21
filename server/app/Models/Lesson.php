<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Collection;

class Lesson extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'video'];

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

    public function courses(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'lesson_user');
    }
}
