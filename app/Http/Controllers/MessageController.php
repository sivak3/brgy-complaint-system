<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function index()
    {
        $messages = Message::where('receiver_id', Auth::id())
                    ->orWhere('sender_id', Auth::id())
                    ->latest()->get();
        return view('messages.index', compact('messages'));
    }

    public function create()
    {
        $users = User::where('id', '!=', Auth::id())->get();
        return view('messages.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'body'        => 'required|string',
        ]);

        Message::create([
            'sender_id'   => Auth::id(),
            'receiver_id' => $request->receiver_id,
            'body'        => $request->body,
            'is_read'     => false,
        ]);

        return redirect()->route('messages.index')
                         ->with('success', 'Message sent successfully!');
    }

    public function show(Message $message)
    {
        $message->update(['is_read' => true]);
        return view('messages.show', compact('message'));
    }
}