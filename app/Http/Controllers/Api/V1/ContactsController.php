<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class ContactsController extends Controller
{
    public function index()
    {
        try {
            $userId = Auth::id();
            $contact = Contact::where('user_id', $userId)->first();

            return response()->json([
                'success' => true,
                'message' => 'Contacts data fetched successfully.',
                'contact_data' => $contact
            ], 200);
        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong while fetching contacts data.',
                'errors' => $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'title' => 'required|string|max:50',
                'description' => 'required|string|max:255',
                'primary_email' => 'required|email|max:200',
                'social_links' => 'nullable|array|max:10',
                'social_links.*' => 'nullable|url|max:255',
            ]);

            $contact = Contact::updateOrCreate(
                ['user_id' => Auth::id()],
                $validated
            );

            $statusCode = $contact->wasRecentlyCreated ? 201 : 200;

            return response()->json([
                'success' => true,
                'message' => $contact->wasRecentlyCreated
                    ? 'Contact created successfully.'
                    : 'Contact updated successfully.',
                'contact_data' => $contact
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
                'message' => 'Something went wrong while creating contact.',
                'errors' => $e->getMessage()
            ], 500);
        }
    }
}
