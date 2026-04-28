<x-app-layout>
    <x-slot name="header">
        <div style="display:flex;align-items:center;gap:12px;">
            <a href="{{ route('complaints.index') }}" style="width:36px;height:36px;background:white;border:1px solid #e8ecf4;border-radius:10px;display:flex;align-items:center;justify-content:center;text-decoration:none;color:#64748b;font-size:18px;transition:all 0.2s;" onmouseover="this.style.borderColor='#1a3a6b';this.style.color='#1a3a6b'" onmouseout="this.style.borderColor='#e8ecf4';this.style.color='#64748b'">←</a>
            <div>
                <p style="font-size:12px;color:#94a3b8;font-weight:500;text-transform:uppercase;letter-spacing:1px;">Resident Services</p>
                <h1 class="font-display" style="font-size:24px;color:#0f2144;margin-top:2px;">File a Complaint</h1>
            </div>
        </div>
    </x-slot>

    <div style="max-width:700px;">
        <div class="card fade-in fade-in-1" style="overflow:hidden;">
            <div style="background:linear-gradient(135deg,#0f2144,#1a3a6b);padding:24px 28px;">
                <h3 style="color:white;font-size:16px;font-weight:600;">📋 New Complaint Form</h3>
                <p style="color:rgba(255,255,255,0.5);font-size:13px;margin-top:4px;">Fill in the details of your complaint below</p>
            </div>
            <div style="padding:32px 28px;">
                <form method="POST" action="{{ route('complaints.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div style="margin-bottom:22px;">
                        <label class="form-label">Complaint Title <span style="color:#ef4444;">*</span></label>
                        <input type="text" name="title" value="{{ old('title') }}"
                               class="form-input" placeholder="Brief title of your complaint" required>
                        @error('title')<p style="color:#ef4444;font-size:12px;margin-top:6px;">{{ $message }}</p>@enderror
                    </div>

                    <div style="margin-bottom:22px;">
                        <label class="form-label">Category <span style="color:#ef4444;">*</span></label>
                        <select name="category" class="form-input" required>
                            <option value="">-- Select Category --</option>
                            <option value="noise" {{ old('category')=='noise'?'selected':'' }}>🔊 Noise Complaint</option>
                            <option value="garbage" {{ old('category')=='garbage'?'selected':'' }}>🗑️ Garbage / Sanitation</option>
                            <option value="road" {{ old('category')=='road'?'selected':'' }}>🛣️ Road / Infrastructure</option>
                            <option value="safety" {{ old('category')=='safety'?'selected':'' }}>🛡️ Safety / Security</option>
                            <option value="other" {{ old('category')=='other'?'selected':'' }}>📌 Other</option>
                        </select>
                        @error('category')<p style="color:#ef4444;font-size:12px;margin-top:6px;">{{ $message }}</p>@enderror
                    </div>

                    <div style="margin-bottom:22px;">
                        <label class="form-label">Description <span style="color:#ef4444;">*</span></label>
                        <textarea name="description" rows="5" class="form-input"
                                  placeholder="Describe your complaint in detail..." required>{{ old('description') }}</textarea>
                        @error('description')<p style="color:#ef4444;font-size:12px;margin-top:6px;">{{ $message }}</p>@enderror
                    </div>

                    <div style="margin-bottom:28px;">
                        <label class="form-label">Attachment <span style="color:#94a3b8;font-weight:400;">(optional)</span></label>
                        <div style="position:relative;border:2px dashed #e2e8f0;border-radius:10px;padding:20px;text-align:center;transition:all 0.2s;cursor:pointer;"
                             onmouseover="this.style.borderColor='#1a3a6b'" onmouseout="this.style.borderColor='#e2e8f0'"
                             onclick="document.getElementById('attachment-input').click()">
                            <p style="font-size:24px;margin-bottom:8px;">📎</p>
                            <p style="font-size:13px;color:#64748b;margin-bottom:8px;">Click to upload or drag and drop</p>
                            <p id="file-name" style="font-size:12px;color:#94a3b8;">JPG, PNG, PDF (max 2MB)</p>
                        </div>
                        <input type="file" id="attachment-input" name="attachment" accept=".jpg,.png,.pdf" style="display:none;"
                               onchange="document.getElementById('file-name').textContent=this.files[0]?.name||'No file chosen'">
                        @error('attachment')<p style="color:#ef4444;font-size:12px;margin-top:6px;">{{ $message }}</p>@enderror
                    </div>

                    <div style="display:flex;gap:12px;">
                        <button type="submit" class="btn-primary">Submit Complaint</button>
                        <a href="{{ route('complaints.index') }}" class="btn-outline">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>