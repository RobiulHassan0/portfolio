<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Skill;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class SkillsController extends Controller
{
    public function index()
    {
        try {
            $skills = auth()->user()->skills()->orderBy('sort_order')->get();             

            return response()->json([
                'success' => true,
                'message' => 'User Skills fetched successfully.',
                'skill_list' => $skills,
            ], 200);
        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong while fetching skills.',
                'errors' => $e->getMessage(),
            ]);
        }
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:50',
                'category' => "nullable|in:frontend,backend",                
                'description' => 'nullable|string|max:150',
                'level' => 'nullable|in:Beginner,Intermediate,Expert',
                'icon' => 'string|nullable',
                'proficiency' => 'integer|nullable|min:0|max:100',
                'sort_order' => 'integer|nullable|min:0',
                'is_active' => 'boolean|nullable',
                'featured' => 'boolean|nullable'
            ]);

            $skill = Auth::user()->skills()->create($validated);

            return response()->json([
                'success' => true,
                'message' => 'Skill created successfully.',
                'skill_data' => $skill,
            ], 201);

        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed.',
                'errors' => $e->errors()
            ], 422);

        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Skill not found.',
            ], 404);

        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong while creating skill.',
                'errors' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $validated = $request->validate([
                'name' => 'sometimes|required|string|max:50',
                'category' => "nullable|in:frontend,backend", 
                'description' => 'sometimes|nullable|string|max:100',
                'level' => 'sometimes|nullable|in:Beginner,Intermediate,Expert', 
                'icon' => 'sometimes|string|nullable',
                'proficiency' => 'sometimes|integer|nullable|min:0|max:100',
                'sort_order' => 'sometimes|integer|nullable|min:0',
                'is_active' => 'sometimes|boolean|nullable',
                'featured' => 'boolean|nullable|sometimes'
            ]);

            $skill = Auth::user()->skills()->findOrFail($id);
            $skill->update($validated);
            $skill->refresh();

            return response()->json([
                'success' => true,
                'message' => 'Skill updated successfully.',
                'skill_data' => $skill,
            ], 200);

        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed.',
                'errors' => $e->errors()
            ], 422);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Skill not found.',
            ], 404);

        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong while updating skill.',
                'errors' => $e->getMessage()
            ], 500);
        }
    }

    public function toggleStatus($id){
        try {
            $skill = Skill::findOrFail($id);

            $skill->is_active = !$skill->is_active;
            $skill->save();

            return response()->json([
                'success' => true,
                'message' => 'Skill Status updated!',
                'is_active' => $skill->is_active
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Skill not found.',
            ], 404);

        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong while updating skill.',
                'errors' => $e->getMessage() 
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $skill = Auth::user()->skills()->findOrFail($id);
            $skill->delete();

            return response()->json([
                'success' => true,
                'message' => 'Skill deleted successfully.',
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Skill not found.',
            ], 404);
        }
    }
}
