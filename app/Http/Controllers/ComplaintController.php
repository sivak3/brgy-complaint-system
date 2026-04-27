<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ComplaintController extends Controller
{
    public function index()
    {
        $complaints = Complaint::where('user_id', Auth::id())
            ->latest()
            ->get();
        return view('complaints.index', compact('complaints'));
    }

    public function create()
    {
        return view('complaints.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'category'    => 'required|string',
            'description' => 'required|string',
            'attachment'  => 'nullable|file|mimes:jpg,png,pdf|max:2048',
        ]);

        $path = null;
        if ($request->hasFile('attachment')) {
            $path = $request->file('attachment')->store('attachments', 'public');
        }

        Complaint::create([
            'user_id'     => Auth::id(),
            'title'       => $request->title,
            'category'    => $request->category,
            'description' => $request->description,
            'status'      => 'pending',
            'attachment'  => $path,
        ]);

        return redirect()->route('complaints.index')
                         ->with('success', 'Complaint submitted successfully!');
    }

    public function show(Complaint $complaint)
    {
        // Make sure resident can only view their own complaints
        if ($complaint->user_id !== Auth::id() && !Auth::user()->hasRole('admin')) {
            abort(403);
        }

        return view('complaints.show', compact('complaint'));
    }
}