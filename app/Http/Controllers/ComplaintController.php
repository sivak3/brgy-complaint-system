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
                        ->latest()->get();
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
            'description' => 'required|string',
            'category'    => 'required|string',
            'attachment'  => 'nullable|file|mimes:jpg,png,pdf|max:2048',
        ]);

        $path = null;
        if ($request->hasFile('attachment')) {
            $path = $request->file('attachment')
                            ->store('attachments', 'public');
        }

        Complaint::create([
            'user_id'     => Auth::id(),
            'title'       => $request->title,
            'description' => $request->description,
            'category'    => $request->category,
            'attachment'  => $path,
            'status'      => 'pending',
        ]);

        return redirect()->route('complaints.index')
                         ->with('success', 'Complaint submitted successfully!');
    }

    public function show(Complaint $complaint)
    {
        return view('complaints.show', compact('complaint'));
    }
}