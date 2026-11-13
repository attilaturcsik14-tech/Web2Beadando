<?php

namespace App\Http\Controllers;

use App\Models\Message;

class MessageController extends Controller
{
    public function index()
    {
        // fordított időrend: a legfrissebb legyen elöl
        $messages = Message::orderBy('created_at', 'desc')->get();

        return view('messages', compact('messages'));
    }
}
