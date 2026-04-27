<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notifications\NewMessageReceived;

class MessageController extends Controller
{
    public function index()
    {
        $messages = Message::where('sender_id', Auth::id())
            ->orWhere('receiver_id', Auth::id())
            ->with(['sender', 'receiver'])
            ->latest()
            ->get()
            ->groupBy(function ($message) {
                return $message->sender_id === Auth::id()
                    ? $message->receiver_id
                    : $message->sender_id;
            });

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
            'body'        => 'required|string|max:2000',
        ]);

        $message = Message::create([
            'sender_id'   => Auth::id(),
            'receiver_id' => $request->receiver_id,
            'body'        => $request->body,
        ]);

        // Notify the receiver
        $receiver = User::findOrFail($request->receiver_id);
        $receiver->notify(new NewMessageReceived($message));

        return redirect()->route('messages.index')
                         ->with('success', 'Message sent successfully!');
    }

    public function show(Message $message)
    {
        $otherId = $message->sender_id === Auth::id()
            ? $message->receiver_id
            : $message->sender_id;

        $otherUser = User::findOrFail($otherId);

        $thread = Message::where(function ($q) use ($otherId) {
                $q->where('sender_id', Auth::id())
                  ->where('receiver_id', $otherId);
            })->orWhere(function ($q) use ($otherId) {
                $q->where('sender_id', $otherId)
                  ->where('receiver_id', Auth::id());
            })
            ->with(['sender', 'receiver'])
            ->oldest()
            ->get();

        // If admin viewing resident conversation
        if (Auth::user()->hasRole('admin') && $thread->isEmpty()) {
            $thread = Message::where(function ($q) use ($message) {
                    $q->where('sender_id', $message->sender_id)
                      ->where('receiver_id', $message->receiver_id);
                })->orWhere(function ($q) use ($message) {
                    $q->where('sender_id', $message->receiver_id)
                      ->where('receiver_id', $message->sender_id);
                })
                ->with(['sender', 'receiver'])
                ->oldest()
                ->get();

            $otherUser = $message->sender_id === Auth::id()
                ? $message->receiver
                : $message->sender;
        }

        return view('messages.show', compact('thread', 'otherUser'));
    }

    public function reply(Request $request, Message $message)
    {
        $request->validate([
            'body' => 'required|string|max:2000',
        ]);

        $receiverId = $message->sender_id === Auth::id()
            ? $message->receiver_id
            : $message->sender_id;

        // If admin, reply to the other person in the thread
        if (Auth::user()->hasRole('admin')) {
            $receiverId = $message->sender_id === Auth::id()
                ? $message->receiver_id
                : $message->sender_id;
        }

        $newMessage = Message::create([
            'sender_id'   => Auth::id(),
            'receiver_id' => $receiverId,
            'body'        => $request->body,
        ]);

        // Notify the receiver
        $receiver = User::findOrFail($receiverId);
        $receiver->notify(new NewMessageReceived($newMessage));

        return redirect()->route('messages.show', $message)
                         ->with('success', 'Reply sent!');
    }
}