<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class ServicesController extends Controller
{
    public function index()
    {
        try {

            $services = Auth::user()->services()->orderBy('sort_order')->get();

            return response()->json([
                'success' => true,
                'message' => 'Services data fetched successfully.',
                'all_services' => $services
            ], 200);
        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong while fetching services.',
                'errors' => $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'title' => "required|string|max:50",
                'description' => "nullable|string|max:150",
                'icon' => "nullable|string|max:50",

                'category' => 'required|in:frontend,backend',

                'stack' => "nullable|array",
                'features' => 'nullable|array',
                'setup' => 'nullable|array',

                'is_active' => 'boolean',
                'featured' => 'boolean',
                'sort_order' => 'integer|nullable|min:0'
            ]);

            $service = Service::create([
                'user_id' => auth()->id(),
                'title' => $validated['title'],
                'description' => $validated['description'] ?? null,
                'icon' => $validated['icon'] ?? null,
                'category' => $validated['category'],
                'is_active' => $validated['is_active'] ?? true,
                'featured' => $validated['featured'] ?? false,
                'sort_order' => $validated['sort_order'] ?? 0,
                'service_items' => [
                    'stack' => $validated['stack'] ?? [],
                    'features' => $validated['features'] ?? [],
                    'setup' => $validated['setup'] ?? [],
                ],
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Service data created successfully.',
                'service_data' => $service
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
                'message' => 'Something went wrong while creating service.',
                'errors' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $validated = $request->validate([
                'title' => "sometimes|string|max:50",
                'description' => "nullable|string|max:150",
                'icon' => "nullable|string|max:50",

                'category' => 'sometimes|in:frontend,backend',

                'stack' => "nullable|array",
                'features' => 'nullable|array',
                'setup' => 'nullable|array',

                'is_active' => 'boolean',
                'featured' => 'boolean',
                'sort_order' => 'integer|nullable|min:0'
            ]);

            $service = Auth::user()->services()->findOrFail($id);

            $service->update([
                'title' => $validated['title'] ?? $service->title,
                'description' => $validated['description'] ?? $service->description,
                'icon' => $validated['icon'] ?? $service->icon,
                'category' => $validated['category'] ?? $service->category,
                'is_active' => $validated['is_active'] ?? $service->is_active,
                'featured' => $validated['featured'] ?? $service->featured,
                'sort_order' => $validated['sort_order'] ?? $service->sort_order,

                'service_items' => [
                    'stack' => $validated['stack'] ?? $service->service_items['stack'] ?? [],
                    'features' => $validated['features'] ?? $service->service_items['features'] ?? [],
                    'setup' => $validated['setup'] ?? $service->service_items['setup'] ?? [],
                ],
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Service updated successfully.',
                'service_data' => $service
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
                'message' => 'Something went wrong while updating service.',
                'errors' => $e->getMessage()
            ], 500);
        }
    }

    public function status($id)
    {
        try {
            $service = Service::findOrFail($id);

            $service->is_active = !$service->is_active;
            $service->save();

            return response()->json([
                'success' => true,
                'message' => 'Service status updated',
                'is_active' => $service->is_active
            ]);
        }catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Service not found.',
            ], 404);

        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong while updating service.',
                'errors' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $service = Auth::user()->services()->findOrFail($id);

            $service->delete();

            return response()->json([
                'success' => true,
                'message' => 'Service deleted successfully.',
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Service not found.',
                'errors' => $e->getMessage()
            ], 404);
        }
    }
}
