<?php

// app/Http/Middleware/TrimStrings.php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\TrimStrings as Middleware;

class TrimStrings extends Middleware
{
    protected $except = [
        // Attributes that should not be trimmed
    ];
}
