<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\Lesson;

class LessonController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $lesson = Lesson::create($request->all());

        if (!$lesson) {
            return response()->json([
                'message' => 'lesson not created'
            ], 419);
        }

        return response()->json([
                'message' => 'lesson created'
            ], 200);
    }

    public function index(): JsonResponse
    {
        $lessons = Lesson::apiData();
        return response()->json($lessons);
    }

    public function update(Request $request, int $id): JsonResponse
    {
        $lesson = Lesson::find($id);
        $lesson->update($request->all());

        if (!$lesson) {
            return response()->json([
                'message' => 'lesson not update'
            ], 419);
        }

        return response()->json([
                'message' => 'lesson update'
            ], 200);
    }

    public function destroy(int $id): JsonResponse
    {
        $lesson = Lesson::find($id);

        if (!$lesson) {
            return response()->json([
                'message' => 'lesson not deleted'
            ], 419);
        }

        return response()->json([
                'message' => 'lesson deleted'
            ], 200);
    }
}
