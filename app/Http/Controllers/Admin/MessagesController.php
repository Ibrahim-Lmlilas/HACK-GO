<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Channel;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;

class MessagesController extends Controller
{
    /**
     * Display a listing of the message channels.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $channels = Channel::with(['trip', 'users'])->get();
        return view('admin.messages.index', compact('channels'));
    }

    /**
     * Display the specified channel with its messages.
     *
     * @param  \App\Models\Channel  $channel
     * @return \Illuminate\Http\Response
     */
    public function show(Channel $channel)
    {
        $channel->load(['messages.sender', 'users', 'trip']);
        return view('admin.messages.show', compact('channel'));
    }
}
