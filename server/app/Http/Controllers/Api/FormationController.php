<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\Formation;

class FormationController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $formation = Formation::create($request->all());

        if (!$formation) {
            return response()->json([
                'message' => 'formation not created'
            ], 419);
        }

        return response()->json([
                'message' => 'formation created'
            ], 200);
    }

    public function index(): JsonResponse
    {
        $formations = Formation::apiData();
        return response()->json($formations);
    }

    public function update(Request $request, int $id): JsonResponse
    {
        $formation = Formation::find($id);
        $formation->update($request->all());

        if (!$formation) {
            return response()->json([
                'message' => 'formation not update'
            ], 419);
        }

        return response()->json([
                'message' => 'formation update'
            ], 200);
    }

    public function destroy(int $id): JsonResponse
    {
        $formation = Formation::find($id);

        if (!$formation) {
            return response()->json([
                'message' => 'formation not deleted'
            ], 419);
        }

        return response()->json([
                'message' => 'formation deleted'
            ], 200);
    }
}
