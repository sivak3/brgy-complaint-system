<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use App\Models\Feedback;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalComplaints    = Complaint::count();
        $pendingComplaints  = Complaint::where('status', 'pending')->count();
        $resolvedComplaints = Complaint::where('status', 'resolved')->count();
        $totalFeedbacks     = Feedback::count();
        $totalMessages      = Message::count();
        $totalUsers         = User::count();
        $recentComplaints   = Complaint::with('user')->latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalComplaints',
            'pendingComplaints',
            'resolvedComplaints',
            'totalFeedbacks',
            'totalMessages',
            'totalUsers',
            'recentComplaints'
        ));
    }

    public function complaints()
    {
        $complaints = Complaint::with('user')->latest()->get();
        return view('admin.complaints', compact('complaints'));
    }

    public function showComplaint(Complaint $complaint)
    {
        $complaint->load('user');
         $complaint->update(['is_read' => true]); // 👈 add this
        return view('admin.complaint-show', compact('complaint'));
    }

    public function updateStatus(Request $request, Complaint $complaint)
    {
        $request->validate([
            'status' => 'required|in:pending,in_progress,resolved',
        ]);

        $complaint->update(['status' => $request->status]);

        $complaint->user->notify(new \App\Notifications\ComplaintStatusUpdated($complaint));

        return redirect()->route('admin.complaints')
                         ->with('success', 'Complaint status updated and resident notified!');
    }

    public function feedbacks()
    {
        $feedbacks = Feedback::with('user')->latest()->get();
         Feedback::where('is_read', false)->update(['is_read' => true]); // 👈 add this
        return view('admin.feedbacks', compact('feedbacks'));
    }

    public function users()
    {
        $users = User::latest()->get();
        return view('admin.users', compact('users'));
    }

    public function messages()
    {
        $admin = User::whereHas('roles', function ($q) {
            $q->where('name', 'admin');
        })->first();

        $messages = Message::with(['sender', 'receiver'])
            ->where(function ($q) use ($admin) {
                $q->where('sender_id', $admin->id)
                  ->orWhere('receiver_id', $admin->id);
            })
            ->latest()
            ->get()
            ->groupBy(function ($message) use ($admin) {
                return $message->sender_id === $admin->id
                    ? $message->receiver_id
                    : $message->sender_id;
            });

        return view('admin.messages', compact('messages'));
    }
}