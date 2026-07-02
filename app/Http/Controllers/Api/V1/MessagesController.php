<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class MessagesController extends Controller
{
    public function index()
    {
        try {
            $messages = Auth::user()->messages()->latest()->get();

            return response()->json([
                'success' => true,
                'message' => 'Messages fetched successfully.',
                'all_messages' => $messages
            ], 200);
        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong while fetching messages.',
                'errors' => $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'sender_name' => 'required|string|max:30',
                'sender_email' => 'required|email|max:100',
                'subject' => 'nullable|string|max:100',
                'message' => 'required|string',
            ]);

            $message = new Message([
                'receiver_id' => User::first()->id ?? 1,
                ...$validated
            ]);

            $message->save();

            return response()->json([
                'success' => true,
                'message' => 'Message sent successfully.',
                'client_message' => $message
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
                'message' => 'Something went wrong while sending message.',
                'errors' => $e->getMessage()
            ], 500);
        }
    }

    public function markAsRead($id)
    {
        try {
            $message = Message::where('receiver_id', Auth::id())
                ->where('id', $id)
                ->firstOrFail();

            $message->update(
                ['is_read' => true]
            );

            return response()->json([
                'success' => true,
                'message' => 'Message marked as read.',
            ], 200);
        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong while marking the message as read.',
                'errors' => $e->getMessage()
            ], 500);
        }
    }
    public function show($id)
    {
        try {
            $message = Message::where('receiver_id', Auth::id())
            ->where('id', $id)
            ->firstOrFail();

            $message->update(['is_read' => true]);

            return response()->json([
                'success' => true,
                'message_data' => $message
            ]);

        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong while fetching message.',
                'errors' => $e->getMessage()
            ], 500);
        }
    }


    public function destroy($id)
    {
        try {
            $message = Auth::user()->messages()->findOrFail($id);
            $message->delete();

            return response()->json([
                'success' => true,
                'message' => 'Message deleted successfully.',
            ], 200);
        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong while deleting message.',
                'errors' => $e->getMessage()
            ], 500);
        }
    }
}
