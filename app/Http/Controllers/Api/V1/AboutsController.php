<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\About;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AboutsController extends Controller
{
    public function index()
    {
        try {
            $about = About::where('user_id', Auth::id())->firstOrFail();

            return response()->json([
                'success' => true,
                'message' => 'User Abouts fetched successfully.',
                'about_data' => $about,
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong while fetching about.',
                'errors' => $e->getMessage(),
            ]);
        }
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'description' => 'required|string',
                'highlights' => 'array|nullable|max:10',
                'highlights.*' => 'string|max:100',
                'location' => 'nullable|string|max:100',
                'availability' => 'nullable|string|max:100',
                'workflow' => 'nullable|string|max:100',
                'status' => 'nullable|in:available_for_work,not_available',
                'image_path' => 'nullable|url|max:300'
            ]);

            $about = About::updateOrCreate(
                ['user_id' => Auth::id()],
                $validated
            );

            $statusCode = $about->wasRecentlyCreated ? 201 : 200;

            return response()->json([
                'success' => true,
                'message' => $about->wasRecentlyCreated
                    ? 'About created successfully.'
                    : 'About updated successfully.',
                'about_data' => $about,
            ], $statusCode);

        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed.',
                'errors' => $e->errors()
            ], 422);
        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong while creating about.',
                'errors' => $e->getMessage()
            ], 500);
        }
    }
}
