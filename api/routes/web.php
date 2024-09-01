<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return response()->json([
        'Laravel' => app()->version()
    ]);
});

Route::post('/testPost', function (Request $request) {
    return response()->json([
        "resposta" => $request->input('resposta')
    ]);
});

require __DIR__.'/auth.php';
