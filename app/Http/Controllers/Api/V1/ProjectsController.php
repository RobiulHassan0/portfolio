<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class ProjectsController extends Controller
{
    public function index()
    {
        try {
            $projects = Project::with('user:id,name')->orderBy('sort_order')->get();

            return response()->json([
                'success' => true,
                'message' => 'Projects fetched succcessfully',
                'projects_data' => $projects,
            ], 200);
        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong while fetching projects.',
                'errors' => $e->getMessage()
            ], 500);
        }
    }

    public function status($id)
    {
        try {
            $project = Project::findOrFail($id);
            $project->is_active = !$project->is_active;
            $project->save();

            return response()->json([
                'success' => true,
                'message' => 'Project status updated',
                'is_active' => $project->is_active,
            ], 200);

        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Skill not found.',
            ], 404);

        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong while updating project.',
                'errors' => $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'title' => "required|string|max:100",
                "description" => "string|nullable",
                'thumbnail' => "string|max:255|nullable",
                'live_url' => "url|max:255|nullable",
                'github_url' => "url|max:255|nullable",
                'tech_stack' => 'nullable|array|max:20',
                'tech_stack.*' => 'string|max:50',
                'featured' => 'boolean|nullable',
                'is_active' => 'boolean|nullable',
                'sort_order' => 'integer|min:0|nullable'
            ]);

            // if (!isset($validated['sort_order'])) {
            //     $maxOrder = Project::where('user_id', Auth::id())->max('sort_order') ?? 0;
            //     $validated['sort_order'] = $maxOrder + 1;
            // }

            $project = auth()->user()->projects()->create($validated);

            return response()->json([
                'success' => true,
                'message' => 'Project created successfully.',
                'project_data' => $project,
            ], 201);
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed.',
                'errors' => $e->errors()
            ], 422);
        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong while creating project.',
                'errors' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $validated = $request->validate([
                'title' => "sometimes|required|string|max:100",
                "description" => "sometimes|string|nullable",
                'thumbnail' => "sometimes|string|max:255|nullable",
                'live_url' => "sometimes|url|max:255|nullable",
                'github_url' => "sometimes|url|max:255|nullable",
                'tech_stack' => 'sometimes|nullable|array|max:20',
                'tech_stack.*' => 'sometimes|nullable|string|max:50',
                'featured' => 'sometimes|nullable|boolean',
                'is_active' => 'sometimes|nullable|boolean',
                'sort_order' => 'sometimes|nullable|integer|min:0'
            ]);

            $project = Auth::user()->projects()->findOrFail($id);

            $project->update($validated);
            $updated = $project->fresh();

            return response()->json([
                'success' => true,
                'message' => 'Project updated successfully.',
                'project_data' => $updated
            ], 200);
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed.',
                'errors' => $e->errors()
            ], 422);
        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong while updating project.',
                'errors' => $e->getMessage()
            ], 500);
        }
    }
    public function destroy($id)
    {
        try {
            $project = auth()->user()->projects()->findOrFail($id);
            $project->delete();
            $project->refresh();

            return response()->json([
                'success' => true,
                'message' => 'Project deleted successfully.',
                'project_data' => $project,
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Project not found.',
                'errors' => $e->getMessage()
            ], 404);
        }
    }
}
 