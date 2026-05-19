<x-app-layout>
    <x-slot name="header">Profile Settings</x-slot>

    <div class="max-w-2xl space-y-6">

        {{-- ── Profile Picture ── --}}
        <div class="card p-6">
            <h2 class="text-base font-semibold text-white mb-1">Profile Picture</h2>
            <p class="text-slate-500 text-sm mb-5">Upload a photo that will be visible to you and administrators.</p>

            <div class="flex items-center gap-6 mb-6">
                {{-- Avatar Preview --}}
                <div class="relative group" id="avatar-wrapper">
                    <img id="avatar-preview"
                         src="{{ auth()->user()->avatarUrl() }}"
                         alt="Profile Picture"
                         class="w-24 h-24 rounded-full object-cover ring-4 ring-blue-500/30 shadow-xl transition-all duration-300 group-hover:ring-blue-500/60">
                    <div class="absolute inset-0 rounded-full bg-black/40 opacity-0 group-hover:opacity-100 flex items-center justify-center transition-all duration-200 cursor-pointer"
                         onclick="document.getElementById('avatar-input').click()">
                        <span class="text-white text-xs font-semibold">Change</span>
                    </div>
                </div>
                <div>
                    <p class="text-sm text-slate-300 font-medium">{{ auth()->user()->name }}</p>
                    <p class="text-xs text-slate-500 mb-3">{{ auth()->user()->email }}</p>
                    <div class="flex gap-2 flex-wrap">
                        <button type="button" onclick="document.getElementById('avatar-input').click()"
                                class="btn-primary text-xs py-1.5 px-3">
                            📷 Upload Photo
                        </button>
                        @if(auth()->user()->avatar_path)
                        <form method="POST" action="{{ route('profile.avatar.remove') }}" class="inline"
                              onsubmit="return confirm('Remove profile picture?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn-secondary text-xs py-1.5 px-3">🗑️ Remove</button>
                        </form>
                        @endif
                    </div>
                    <p class="text-xs text-slate-600 mt-2">JPG, PNG, WEBP or GIF • Max 2MB</p>
                </div>
            </div>

            {{-- Hidden upload form --}}
            <form method="POST" action="{{ route('profile.avatar.upload') }}" enctype="multipart/form-data" id="avatar-form">
                @csrf
                <input type="file" id="avatar-input" name="avatar" accept="image/*" class="hidden"
                       onchange="previewAndSubmit(this)">
            </form>

            @if(session('status') === 'avatar-updated')
            <div class="flash-success text-sm fade-in">✅ Profile picture updated successfully!</div>
            @endif
            @if(session('status') === 'avatar-removed')
            <div class="flash-success text-sm fade-in">✅ Profile picture removed.</div>
            @endif
            @error('avatar')
            <div class="flash-error text-sm mt-2">❌ {{ $message }}</div>
            @enderror
        </div>

        {{-- ── My Translation History Link ── --}}
        <div class="card p-6 flex items-center justify-between">
            <div>
                <h2 class="text-base font-semibold text-white mb-1">My Translation History</h2>
                <p class="text-slate-500 text-sm">View all translations you've personally submitted.</p>
            </div>
            <a href="{{ route('profile.history') }}" class="btn-primary text-sm whitespace-nowrap">
                📋 View My History →
            </a>
        </div>

        {{-- ── Update Profile Info ── --}}
        <div class="card p-6">
            <h2 class="text-base font-semibold text-white mb-1">Profile Information</h2>
            <p class="text-slate-500 text-sm mb-5">Update your display name and email address.</p>

            <form method="POST" action="{{ route('profile.update') }}" class="space-y-4">
                @csrf @method('PATCH')

                <div>
                    <label for="name" class="block text-sm text-slate-400 mb-1.5">Full Name</label>
                    <input id="name" name="name" type="text" value="{{ old('name', $user->name) }}" required class="input-field">
                    @error('name')<p class="mt-1 text-xs text-red-400">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label for="email" class="block text-sm text-slate-400 mb-1.5">Email Address</label>
                    <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" required class="input-field">
                    @error('email')<p class="mt-1 text-xs text-red-400">{{ $message }}</p>@enderror
                </div>

                <div class="flex items-center gap-4 pt-2">
                    <button type="submit" class="btn-primary">Save Changes</button>
                    @if(session('status') === 'profile-updated')
                    <span class="text-sm text-emerald-400 fade-in">✅ Saved!</span>
                    @endif
                </div>
            </form>
        </div>

        {{-- ── Change Password ── --}}
        <div class="card p-6">
            <h2 class="text-base font-semibold text-white mb-1">Change Password</h2>
            <p class="text-slate-500 text-sm mb-5">Ensure your account uses a long, random password to stay secure.</p>

            <form method="POST" action="{{ route('password.update') }}" class="space-y-4">
                @csrf @method('PUT')

                <div>
                    <label for="current_password" class="block text-sm text-slate-400 mb-1.5">Current Password</label>
                    <input id="current_password" name="current_password" type="password" autocomplete="current-password" class="input-field" placeholder="••••••••">
                    @error('current_password', 'updatePassword')<p class="mt-1 text-xs text-red-400">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label for="password" class="block text-sm text-slate-400 mb-1.5">New Password</label>
                    <input id="password" name="password" type="password" autocomplete="new-password" class="input-field" placeholder="Min 8 characters">
                    @error('password', 'updatePassword')<p class="mt-1 text-xs text-red-400">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm text-slate-400 mb-1.5">Confirm New Password</label>
                    <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" class="input-field" placeholder="Repeat new password">
                </div>

                <div class="flex items-center gap-4 pt-2">
                    <button type="submit" class="btn-primary">Update Password</button>
                    @if(session('status') === 'password-updated')
                    <span class="text-sm text-emerald-400 fade-in">✅ Password updated!</span>
                    @endif
                </div>
            </form>
        </div>

        {{-- ── Delete Account ── --}}
        <div class="card p-6 border border-red-900/30" style="background:rgba(220,38,38,0.04);">
            <h2 class="text-base font-semibold text-red-400 mb-1">Delete Account</h2>
            <p class="text-slate-500 text-sm mb-5">
                Once your account is deleted, all data will be permanently removed. This action cannot be undone.
            </p>

            <button onclick="document.getElementById('delete-modal').classList.remove('hidden')" class="btn-danger text-sm">
                🗑️ Delete My Account
            </button>
        </div>

    </div>

    {{-- ── Delete Account Modal ── --}}
    <div id="delete-modal" class="hidden fixed inset-0 z-50 flex items-center justify-center px-4" style="background:rgba(2,8,23,.85); backdrop-filter:blur(8px);">
        <div class="card border border-red-900/40 p-8 max-w-md w-full" style="background:#0f172a;">
            <div class="text-center mb-6">
                <div class="text-4xl mb-3">⚠️</div>
                <h3 class="text-xl font-bold text-white mb-2">Confirm Account Deletion</h3>
                <p class="text-slate-400 text-sm">This action is permanent and irreversible. All your translations and data will be deleted.</p>
            </div>

            <form method="POST" action="{{ route('profile.destroy') }}" class="space-y-4">
                @csrf @method('DELETE')

                <div>
                    <label for="del_password" class="block text-sm text-slate-400 mb-1.5">Enter your password to confirm</label>
                    <input id="del_password" name="password" type="password" required class="input-field" placeholder="••••••••" autofocus>
                    @error('password', 'userDeletion')<p class="mt-1 text-xs text-red-400">{{ $message }}</p>@enderror
                </div>

                <div class="flex gap-3 pt-2">
                    <button type="button" onclick="document.getElementById('delete-modal').classList.add('hidden')" class="btn-secondary flex-1 text-sm">Cancel</button>
                    <button type="submit" class="btn-danger flex-1 text-sm">Delete Account</button>
                </div>
            </form>
        </div>
    </div>

    <script>
    function previewAndSubmit(input) {
        if (!input.files || !input.files[0]) return;
        const file = input.files[0];
        // Live preview before submit
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('avatar-preview').src = e.target.result;
        };
        reader.readAsDataURL(file);
        // Auto-submit after 200ms to show preview first
        setTimeout(() => document.getElementById('avatar-form').submit(), 300);
    }
    </script>
</x-app-layout>
