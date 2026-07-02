<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\PersonalInfo;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class PersonalInfoController extends Controller
{
    public function index()
    {
        try {
            $personalInfo = PersonalInfo::with('user:id,name')
            ->where('user_id', Auth::id())
            ->firstOrFail();
            
            return response()->json([
                'success' => true,
                'message' => 'User data fetched successfully.',
                'user_data' => $personalInfo
            ], 200);

        } catch(ModelNotFoundException $e){
            return response()->json([
                'success' => false,
                'message' => 'Profile Not found.',
            ], 404);
        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong.',
                'errors' => $e->getMessage()
            ], 500);
        }

    }

    public function store(Request $request){
        try{
            $validated = $request->validate([
                'designation' => 'string|nullable|max:50',
                'bio' => 'string|nullable',
                'profile_photo' => 'string|nullable|max:300',
                'resume_url' => 'url|nullable|max:300',
                'stack' => 'array|nullable|max:10',
                'stack.*' => 'string|max:50',
                'focus' => 'string|nullable|max:150',
                'is_available' => 'boolean|nullable',
                'availability_text' => 'nullable|string|max:100'
            ]);

            if($request->has('name')){
                $user = Auth::user();
                $user->name = $request->input('name');
                $user->save();
            }

            $personalInfo = PersonalInfo::updateOrCreate(              
                ['user_id' => Auth::id()] , 
                [   
                'designation' => $validated['designation'] ?? null,
                'bio' => $validated['bio'] ?? null,
                'profile_photo' => $validated['profile_photo'] ?? null, 
                'resume_url' => $validated['resume_url'] ?? null,
                'stack' => $validated['stack'] ?? null,
                'focus' => $validated['focus'] ?? null,
                'is_available' => $validated['is_available'] ?? null,
                'availability_text' => $validated['availability_text'] ?? null
            ]);
            
            $statusCode = $personalInfo->wasRecentlyCreated ? 201 : 200;

            return response()->json([
                'success' => true,
                'message' => $personalInfo->wasRecentlyCreated 
                ? 'Profile created successfully.'
                : 'Profile updated successfully.',
                'user_data' => $personalInfo
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
                'message' => 'Something went wrong.',
                'errors' => $e->getMessage()
            ], 500);
        }
    }

}
