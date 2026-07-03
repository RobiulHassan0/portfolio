<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        try {
            $validated = $request->validate([
                "name" => "required|string|max:50",
                'email' => "required|email|string|max:30|unique:users,email",
                "password" => "required|string|min:5|max:10|confirmed",
            ]);     

            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password'])
            ]);

            return response()->json([
                'success' => true,
                'message' => 'User created successfully.',
                'user_data' => $user
            ], 201);

        } catch (ValidationException $e) {

            return response()->json([
                'success' => false,
                'message' => 'Validation Error',
                'errors' => $e->errors()
            ], 422);

        } catch (\Throwable $e) {
            
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong while creating user.',
                'errors' => $e->getMessage(),
            ], 500);
        }
    }
    public function login(Request $request)
    {
        try {
            $validated = $request->validate([
                'email' => "required|email|string",
                "password" => "required|string",
            ]);

            $user = User::where('email', $validated['email'])->first();
            
            if(!$user || !Hash::check($validated['password'], $user->password) ){
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid email or password.',
                ], 401);
            }

            // Auth::login($user, $request->has('remember'));

            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'success' => true,
                'message' => 'Login successfull.',
                'user_data' => $user,
                'token' => $token,
            ], 200);

        }catch(ValidationException $e){

            return response()->json([
                'success' => false,
                'message' => 'Validation Error',
                'errors' => $e->errors(),
            ], 422);

        }catch(\Throwable $e){

            return response()->json([
                'success' => false,
                'message' => 'Something went wrong during login.',
                'errors' => $e->getMessage(),
            ], 500);
        }
    }

    public function logout(Request $request){
        try{
            $request->user()->currentAccessToken()->delete();
            return response()->json([
                'success' => true,
                'message' => 'Logged out successful!',
            ], 200);
        }catch(\Throwable $e){
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong during logout.',
                'errors' => $e->getMessage()                
            ], 500);
        }

    }
}
