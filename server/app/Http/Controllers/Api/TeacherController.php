<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TeacherController extends Controller
{

    public function store(Request $request): JsonResponse
    {
        $teacher = Teacher::create($request->all());

        if (!$teacher) {
            return response()->json([
                'message' => 'teacher not created'
            ], 419);
        }

        return response()->json([
                'message' => 'teacher created'
            ], 200);
    }

    public function index(): JsonResponse
    {
        $teachers = Teacher::apiData();
        return response()->json($teachers);
    }

    public function update(Request $request, int $id): JsonResponse
    {
        $teacher = Teacher::find($id);
        $teacher->update($request->all());

        if (!$teacher) {
            return response()->json([
                'message' => 'teacher not update'
            ], 419);
        }

        return response()->json([
                'message' => 'teacher update'
            ], 200);
    }

    public function destroy(int $id): JsonResponse
    {
        $teacher = Teacher::find($id);

        if (!$teacher) {
            return response()->json([
                'message' => 'teacher not deleted'
            ], 419);
        }

        return response()->json([
                'message' => 'teacher deleted'
            ], 200);
    }

}
