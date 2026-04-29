<x-app-layout>
    <x-slot name="header">
        <div>
            <p style="font-size:12px;color:#94a3b8;font-weight:500;text-transform:uppercase;letter-spacing:1px;">Overview</p>
            <h1 class="font-display" style="font-size:24px;color:#c97b5a;margin-top:2px;">Dashboard</h1>
        </div>
    </x-slot>

    @if(auth()->user()->hasRole('admin'))
    {{-- ADMIN DASHBOARD --}}

        <!-- Welcome Banner -->
        <div class="fade-in fade-in-1" style="background:linear-gradient(135deg,#c97b5a 0%,#e8956d 100%);border-radius:20px;padding:32px 36px;margin-bottom:28px;display:flex;justify-content:space-between;align-items:center;overflow:hidden;position:relative;">
            <div style="position:absolute;top:-40px;right:200px;width:200px;height:200px;background:radial-gradient(circle,rgba(255,255,255,0.15) 0%,transparent 70%);border-radius:50%;"></div>
            <div style="position:relative;z-index:1;">
                <p style="color:rgba(255,255,255,0.7);font-size:13px;margin-bottom:8px;">Good day,</p>
                <h2 class="font-display" style="color:white;font-size:28px;margin-bottom:10px;">{{ auth()->user()->name }}</h2>
                <p style="color:rgba(255,255,255,0.6);font-size:14px;">Here's what's happening in your barangay today.</p>
            </div>
            <div style="font-size:80px;opacity:0.2;position:relative;z-index:1;">🏛️</div>
        </div>

        <!-- Stat Cards -->
        <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:20px;margin-bottom:28px;">
            <div class="stat-card fade-in fade-in-1" style="border-top:4px solid #e8956d;">
                <div style="display:flex;justify-content:space-between;align-items:flex-start;">
                    <div>
                        <p style="font-size:12px;color:#94a3b8;font-weight:600;text-transform:uppercase;letter-spacing:0.8px;">Total Complaints</p>
                        <p style="font-size:36px;font-weight:700;color:#c97b5a;margin:8px 0 4px;" class="font-display">{{ \App\Models\Complaint::count() }}</p>
                        <a href="{{ route('admin.complaints') }}" style="font-size:12px;color:#e8956d;text-decoration:none;font-weight:500;">View all →</a>
                    </div>
                    <div style="width:48px;height:48px;background:#fff5f0;border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:22px;">📋</div>
                </div>
            </div>
            <div class="stat-card fade-in fade-in-2" style="border-top:4px solid #f59e0b;">
                <div style="display:flex;justify-content:space-between;align-items:flex-start;">
                    <div>
                        <p style="font-size:12px;color:#94a3b8;font-weight:600;text-transform:uppercase;letter-spacing:0.8px;">Pending</p>
                        <p style="font-size:36px;font-weight:700;color:#f59e0b;margin:8px 0 4px;" class="font-display">{{ \App\Models\Complaint::where('status','pending')->count() }}</p>
                        <p style="font-size:12px;color:#f59e0b;font-weight:500;">Awaiting action</p>
                    </div>
                    <div style="width:48px;height:48px;background:#fffbeb;border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:22px;">⏳</div>
                </div>
            </div>
            <div class="stat-card fade-in fade-in-3" style="border-top:4px solid #10b981;">
                <div style="display:flex;justify-content:space-between;align-items:flex-start;">
                    <div>
                        <p style="font-size:12px;color:#94a3b8;font-weight:600;text-transform:uppercase;letter-spacing:0.8px;">Resolved</p>
                        <p style="font-size:36px;font-weight:700;color:#10b981;margin:8px 0 4px;" class="font-display">{{ \App\Models\Complaint::where('status','resolved')->count() }}</p>
                        <p style="font-size:12px;color:#10b981;font-weight:500;">Successfully closed</p>
                    </div>
                    <div style="width:48px;height:48px;background:#f0fdf4;border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:22px;">✅</div>
                </div>
            </div>
            <div class="stat-card fade-in fade-in-4" style="border-top:4px solid #8b5cf6;">
                <div style="display:flex;justify-content:space-between;align-items:flex-start;">
                    <div>
                        <p style="font-size:12px;color:#94a3b8;font-weight:600;text-transform:uppercase;letter-spacing:0.8px;">Feedbacks</p>
                        <p style="font-size:36px;font-weight:700;color:#8b5cf6;margin:8px 0 4px;" class="font-display">{{ \App\Models\Feedback::count() }}</p>
                        <a href="{{ route('admin.feedbacks') }}" style="font-size:12px;color:#8b5cf6;text-decoration:none;font-weight:500;">View all →</a>
                    </div>
                    <div style="width:48px;height:48px;background:#f5f3ff;border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:22px;">⭐</div>
                </div>
            </div>
            <div class="stat-card fade-in fade-in-5" style="border-top:4px solid #ec4899;">
                <div style="display:flex;justify-content:space-between;align-items:flex-start;">
                    <div>
                        <p style="font-size:12px;color:#94a3b8;font-weight:600;text-transform:uppercase;letter-spacing:0.8px;">Messages</p>
                        <p style="font-size:36px;font-weight:700;color:#ec4899;margin:8px 0 4px;" class="font-display">{{ \App\Models\Message::count() }}</p>
                        <a href="{{ route('admin.messages') }}" style="font-size:12px;color:#ec4899;text-decoration:none;font-weight:500;">View all →</a>
                    </div>
                    <div style="width:48px;height:48px;background:#fdf2f8;border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:22px;">💬</div>
                </div>
            </div>
            <div class="stat-card fade-in fade-in-6" style="border-top:4px solid #e8956d;">
                <div style="display:flex;justify-content:space-between;align-items:flex-start;">
                    <div>
                        <p style="font-size:12px;color:#94a3b8;font-weight:600;text-transform:uppercase;letter-spacing:0.8px;">Residents</p>
                        <p style="font-size:36px;font-weight:700;color:#e8956d;margin:8px 0 4px;" class="font-display">{{ \App\Models\User::count() }}</p>
                        <a href="{{ route('admin.users') }}" style="font-size:12px;color:#e8956d;text-decoration:none;font-weight:500;">View all →</a>
                    </div>
                    <div style="width:48px;height:48px;background:#fff5f0;border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:22px;">👥</div>
                </div>
            </div>
        </div>

        <!-- Recent Complaints Table -->
        <div class="card fade-in fade-in-4">
            <div style="padding:24px 28px;border-bottom:1px solid #fde0d0;display:flex;justify-content:space-between;align-items:center;">
                <div>
                    <h3 style="font-size:16px;font-weight:700;color:#c97b5a;">Recent Complaints</h3>
                    <p style="font-size:13px;color:#94a3b8;margin-top:2px;">Latest submissions from residents</p>
                </div>
                <a href="{{ route('admin.complaints') }}" class="btn-primary" style="font-size:13px;padding:8px 16px;">View All</a>
            </div>
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Resident</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Status</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse(\App\Models\Complaint::with('user')->latest()->take(5)->get() as $complaint)
                    <tr>
                        <td>
                            <div style="display:flex;align-items:center;gap:10px;">
                                <div class="avatar" style="background:#fff5f0;color:#c97b5a;font-size:12px;">{{ strtoupper(substr($complaint->user->name,0,1)) }}</div>
                                <span style="font-weight:500;">{{ $complaint->user->name }}</span>
                            </div>
                        </td>
                        <td style="font-weight:500;color:#c97b5a;">{{ $complaint->title }}</td>
                        <td style="color:#64748b;">{{ ucfirst($complaint->category) }}</td>
                        <td>
                            <span class="badge-{{ $complaint->status }}">
                                {{ $complaint->status === 'in_progress' ? 'In Progress' : ucfirst($complaint->status) }}
                            </span>
                        </td>
                        <td style="color:#94a3b8;">{{ $complaint->created_at->format('M d, Y') }}</td>
                    </tr>
                    @empty
                    <tr><td colspan="5" style="text-align:center;padding:40px;color:#94a3b8;">No complaints yet.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    @else
    {{-- RESIDENT DASHBOARD --}}

        <!-- Welcome Banner -->
        <div class="fade-in fade-in-1" style="background:linear-gradient(135deg,#c97b5a 0%,#e8956d 100%);border-radius:20px;padding:32px 36px;margin-bottom:28px;display:flex;justify-content:space-between;align-items:center;position:relative;overflow:hidden;">
            <div style="position:absolute;top:-40px;right:160px;width:200px;height:200px;background:radial-gradient(circle,rgba(255,255,255,0.15) 0%,transparent 70%);border-radius:50%;"></div>
            <div style="position:relative;z-index:1;">
                <p style="color:rgba(255,255,255,0.7);font-size:13px;margin-bottom:8px;">Welcome back,</p>
                <h2 class="font-display" style="color:white;font-size:28px;margin-bottom:10px;">{{ auth()->user()->name }}</h2>
                <p style="color:rgba(255,255,255,0.6);font-size:14px;">What would you like to do today?</p>
            </div>
            <div style="font-size:80px;opacity:0.2;position:relative;z-index:1;">🏛️</div>
        </div>

        <!-- Quick Actions -->
        <p style="font-size:11px;font-weight:600;color:#94a3b8;text-transform:uppercase;letter-spacing:1.2px;margin-bottom:16px;">Quick Actions</p>
        <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:20px;margin-bottom:28px;">
            <a href="{{ route('complaints.create') }}" class="fade-in fade-in-1" style="text-decoration:none;background:white;border-radius:16px;padding:24px;border:1px solid #fde0d0;transition:all 0.2s;box-shadow:0 2px 16px rgba(232,149,109,0.1);display:block;" onmouseover="this.style.transform='translateY(-4px)';this.style.boxShadow='0 8px 30px rgba(232,149,109,0.2)'" onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='0 2px 16px rgba(232,149,109,0.1)'">
                <div style="width:52px;height:52px;background:linear-gradient(135deg,#e8956d,#c97b5a);border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:24px;margin-bottom:16px;">📋</div>
                <p style="font-weight:700;color:#c97b5a;font-size:15px;margin-bottom:6px;">File a Complaint</p>
                <p style="font-size:13px;color:#94a3b8;">Report a barangay issue</p>
            </a>
            <a href="{{ route('feedbacks.create') }}" class="fade-in fade-in-2" style="text-decoration:none;background:white;border-radius:16px;padding:24px;border:1px solid #fde0d0;transition:all 0.2s;box-shadow:0 2px 16px rgba(232,149,109,0.1);display:block;" onmouseover="this.style.transform='translateY(-4px)';this.style.boxShadow='0 8px 30px rgba(232,149,109,0.2)'" onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='0 2px 16px rgba(232,149,109,0.1)'">
                <div style="width:52px;height:52px;background:linear-gradient(135deg,#f0a87a,#e8956d);border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:24px;margin-bottom:16px;">⭐</div>
                <p style="font-weight:700;color:#c97b5a;font-size:15px;margin-bottom:6px;">Give Feedback</p>
                <p style="font-size:13px;color:#94a3b8;">Rate barangay services</p>
            </a>
            <a href="{{ route('messages.create') }}" class="fade-in fade-in-3" style="text-decoration:none;background:white;border-radius:16px;padding:24px;border:1px solid #fde0d0;transition:all 0.2s;box-shadow:0 2px 16px rgba(232,149,109,0.1);display:block;" onmouseover="this.style.transform='translateY(-4px)';this.style.boxShadow='0 8px 30px rgba(232,149,109,0.2)'" onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='0 2px 16px rgba(232,149,109,0.1)'">
                <div style="width:52px;height:52px;background:linear-gradient(135deg,#7c3aed,#5b21b6);border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:24px;margin-bottom:16px;">💬</div>
                <p style="font-weight:700;color:#c97b5a;font-size:15px;margin-bottom:6px;">Send Message</p>
                <p style="font-size:13px;color:#94a3b8;">Talk to barangay staff</p>
            </a>
        </div>

        <!-- Activity Stats -->
        <p style="font-size:11px;font-weight:600;color:#94a3b8;text-transform:uppercase;letter-spacing:1.2px;margin-bottom:16px;">My Activity</p>
        <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:20px;margin-bottom:28px;">
            <a href="{{ route('complaints.index') }}" style="text-decoration:none;" class="fade-in fade-in-4">
                <div class="stat-card" style="border-left:4px solid #e8956d;cursor:pointer;">
                    <p style="font-size:12px;color:#94a3b8;font-weight:600;text-transform:uppercase;letter-spacing:0.8px;">My Complaints</p>
                    <p style="font-size:36px;font-weight:700;color:#e8956d;margin:8px 0 4px;" class="font-display">{{ auth()->user()->complaints()->count() }}</p>
                    <p style="font-size:12px;color:#94a3b8;">View all →</p>
                </div>
            </a>
            <a href="{{ route('feedbacks.index') }}" style="text-decoration:none;" class="fade-in fade-in-5">
                <div class="stat-card" style="border-left:4px solid #f0a87a;cursor:pointer;">
                    <p style="font-size:12px;color:#94a3b8;font-weight:600;text-transform:uppercase;letter-spacing:0.8px;">My Feedbacks</p>
                    <p style="font-size:36px;font-weight:700;color:#f0a87a;margin:8px 0 4px;" class="font-display">{{ auth()->user()->feedbacks()->count() }}</p>
                    <p style="font-size:12px;color:#94a3b8;">View all →</p>
                </div>
            </a>
            <a href="{{ route('messages.index') }}" style="text-decoration:none;" class="fade-in fade-in-6">
                <div class="stat-card" style="border-left:4px solid #7c3aed;cursor:pointer;">
                    <p style="font-size:12px;color:#94a3b8;font-weight:600;text-transform:uppercase;letter-spacing:0.8px;">My Messages</p>
                    <p style="font-size:36px;font-weight:700;color:#7c3aed;margin:8px 0 4px;" class="font-display">{{ auth()->user()->sentMessages()->count() }}</p>
                    <p style="font-size:12px;color:#94a3b8;">View all →</p>
                </div>
            </a>
        </div>

        <!-- Recent Complaints -->
        <div class="card fade-in fade-in-5">
            <div style="padding:24px 28px;border-bottom:1px solid #fde0d0;display:flex;justify-content:space-between;align-items:center;">
                <div>
                    <h3 style="font-size:16px;font-weight:700;color:#c97b5a;">My Recent Complaints</h3>
                    <p style="font-size:13px;color:#94a3b8;margin-top:2px;">Track your complaint statuses</p>
                </div>
                <a href="{{ route('complaints.create') }}" class="btn-primary" style="font-size:13px;padding:8px 16px;">+ New Complaint</a>
            </div>
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse(auth()->user()->complaints()->latest()->take(5)->get() as $complaint)
                    <tr>
                        <td style="font-weight:500;color:#c97b5a;">{{ $complaint->title }}</td>
                        <td style="color:#64748b;">{{ ucfirst($complaint->category) }}</td>
                        <td><span class="badge-{{ $complaint->status }}">{{ $complaint->status === 'in_progress' ? 'In Progress' : ucfirst($complaint->status) }}</span></td>
                        <td style="color:#94a3b8;">{{ $complaint->created_at->format('M d, Y') }}</td>
                        <td><a href="{{ route('complaints.show', $complaint) }}" style="color:#e8956d;font-size:13px;font-weight:500;text-decoration:none;">View →</a></td>
                    </tr>
                    @empty
                    <tr><td colspan="5" style="text-align:center;padding:40px;color:#94a3b8;">No complaints yet. <a href="{{ route('complaints.create') }}" style="color:#e8956d;font-weight:500;">File one now →</a></td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    @endif
</x-app-layout>