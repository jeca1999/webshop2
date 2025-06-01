<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function sendMessage(Request $request)
    {
        $validated = $request->validate([
            'message' => 'required|string|max:500',
        ]);

        // Logic to send the message using Reverb or other services
        Log::info('Message sent: ' . $validated['message']);

        $message = new \App\Models\Message();
        $message->content = $validated['message'];
        $message->client_id = Auth::id(); // Correctly retrieve the authenticated user's ID
        $message->seller_id = $request->input('seller_id'); // Seller ID should be passed in the request
        $message->save();

        return response()->json(['success' => true, 'message' => 'Message sent successfully!']);
    }

    public function fetchMessages(Request $request)
{
    $sellerId = $request->input('seller_id');

    $messages = \App\Models\Message::where(function ($query) use ($sellerId) {
        $query->where('client_id', Auth::id())
              ->where('seller_id', $sellerId);
    })->orWhere(function ($query) use ($sellerId) {
        $query->where('client_id', $sellerId)
              ->where('seller_id', Auth::id());
    })
    ->orderBy('created_at', 'asc')
    ->get(['content', 'created_at']);

    return response()->json($messages);
}

    public function fetchInbox()
    {
        // Fetch messages from registered client accounts that have messaged the seller
        $messages = \App\Models\Message::whereNotNull('client_id')
            ->where('seller_id', Auth::id()) // Use Auth facade to retrieve authenticated user's ID
            ->with('client') // Assuming a relationship exists
            ->get()
            ->map(function ($message) {
                return [
                    'content' => $message->content,
                    'client_name' => $message->client->name,
                    'timestamp' => $message->created_at->toDateTimeString(),
                ];
            });

        return response()->json($messages);
    }
}
