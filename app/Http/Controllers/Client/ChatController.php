<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Channel;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function show(Channel $channel)
    {
        // Check if user is a member of this channel
        if (!$channel->users->contains(Auth::id())) {
            return redirect()->route('client.chat')
                ->with('error', 'You are not a member of this channel.');
        }

        // Get channel messages with sender information
        $messages = $channel->messages()
            ->with('sender')
            ->orderBy('created_at', 'asc')
            ->get();

        return view('client.chat.show', compact('channel', 'messages'));
    }

    public function store(Channel $channel)
    {
        // Check if user is a member of this channel
        if (!$channel->users->contains(Auth::id())) {
            return redirect()->route('client.chat')
                ->with('error', 'You are not a member of this channel.');
        }

        // Validate the message
        $validated = request()->validate([
            'message' => 'required|string|max:1000'
        ]);

        // Create the message
        $channel->messages()->create([
            'sender_id' => Auth::id(),
            'content' => $validated['message']
        ]);

        return back()->with('success', 'Message sent successfully.');
    }
}
