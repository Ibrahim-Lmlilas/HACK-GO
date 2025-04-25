<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ChannelController extends Controller
{
    public function index()
    {
        // Get all channels where the user is a member
        $channels = Auth::user()->channels()->with(['trip', 'users'])->get();

        return view('client.channels.index', compact('channels'));
    }
}
