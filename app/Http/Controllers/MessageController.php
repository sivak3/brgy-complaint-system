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
        $user = Auth::user();

        $messages = Message::where('sender_id', $user->id)
            ->orWhere('receiver_id', $user->id)
            ->with(['sender', 'receiver'])
            ->latest()
            ->get()
            ->groupBy(function ($message) use ($user) {
                return $message->sender_id === $user->id
                    ? $message->receiver_id
                    : $message->sender_id;
            });

        return view('messages.index', compact('messages'));
    }

    public function create()
    {
        $user = Auth::user();

        if ($user->hasRole('admin')) {
            $users = User::whereDoesntHave('roles', function ($q) {
                $q->where('name', 'admin');
            })->where('id', '!=', $user->id)->get();
        } else {
            $users = User::whereHas('roles', function ($q) {
                $q->where('name', 'admin');
            })->get();
        }

        return view('messages.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'body'        => 'required|string|max:2000',
        ]);

        $user     = Auth::user();
        $receiver = User::findOrFail($request->receiver_id);

        if (!$user->hasRole('admin') && !$receiver->hasRole('admin')) {
            return back()->withErrors(['receiver_id' => 'You can only send messages to the admin.']);
        }

        if ($user->hasRole('admin') && $receiver->hasRole('admin')) {
            return back()->withErrors(['receiver_id' => 'Admin cannot message another admin.']);
        }

        $message = Message::create([
            'sender_id'   => $user->id,
            'receiver_id' => $receiver->id,
            'body'        => $request->body,
        ]);

        $receiver->notify(new NewMessageReceived($message));

        return redirect()->route('messages.index')
                         ->with('success', 'Message sent successfully!');
    }

    public function show(Message $message)
    {
        $user = Auth::user();

        if ($message->sender_id !== $user->id && $message->receiver_id !== $user->id) {
            abort(403);
        }

        $otherId = $message->sender_id === $user->id
            ? $message->receiver_id
            : $message->sender_id;

        $otherUser = User::findOrFail($otherId);

        $thread = Message::where(function ($q) use ($user, $otherId) {
                $q->where('sender_id', $user->id)
                  ->where('receiver_id', $otherId);
            })->orWhere(function ($q) use ($user, $otherId) {
                $q->where('sender_id', $otherId)
                  ->where('receiver_id', $user->id);
            })
            ->with(['sender', 'receiver'])
            ->oldest()
            ->get();

        // Mark messages as read in messages table
        Message::where('receiver_id', $user->id)
            ->whereIn('id', $thread->pluck('id'))
            ->update(['is_read' => true]);

        // Mark related Laravel notifications as read (clears bell + sidebar)
        $threadMessageIds = $thread->pluck('id')->toArray();
        $user->unreadNotifications()
            ->where('type', 'App\Notifications\NewMessageReceived')
            ->get()
            ->filter(fn($n) => in_array($n->data['message_id'] ?? null, $threadMessageIds))
            ->each->markAsRead();

        return view('messages.show', compact('thread', 'otherUser'));
    }

    public function reply(Request $request, Message $message)
    {
        $request->validate([
            'body' => 'required|string|max:2000',
        ]);

        $user = Auth::user();

        if ($message->sender_id !== $user->id && $message->receiver_id !== $user->id) {
            abort(403);
        }

        $receiverId = $message->sender_id === $user->id
            ? $message->receiver_id
            : $message->sender_id;

        $newMessage = Message::create([
            'sender_id'   => $user->id,
            'receiver_id' => $receiverId,
            'body'        => $request->body,
        ]);

        $receiver = User::findOrFail($receiverId);
        $receiver->notify(new NewMessageReceived($newMessage));

        return redirect()->route('messages.show', $message)
                         ->with('success', 'Reply sent!');
    }
}