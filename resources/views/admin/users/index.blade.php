@extends('layouts.admin')

@section('title', 'Users | RosTop Admin')

@section('content')
<div class="adm-page-head">
    <div>
        <h1 class="adm-page-title">Users</h1>
        <p class="adm-page-sub">OTP দিয়ে রেজিস্টার্ড সব ইউজার — অ্যাডমিন অ্যাক্সেস ম্যানেজ করুন।</p>
    </div>
</div>

<div class="adm-filter-bar">
    <form action="{{ route('admin.users.index') }}" method="GET">
        <input type="text" name="q" value="{{ request('q') }}" class="adm-input adm-input-sm" style="width: 260px;" placeholder="Name / phone / e-mail খুঁজুন...">
        <button type="submit" class="adm-btn adm-btn-primary adm-btn-xs">Search</button>
        <a href="{{ route('admin.users.index') }}" class="adm-btn adm-btn-secondary adm-btn-xs">Reset</a>
    </form>
</div>

<div class="adm-card">
    <div class="adm-table-wrap">
        <table class="adm-table">
            <thead>
                <tr>
                    <th>User</th>
                    <th>Phone</th>
                    <th>Joined</th>
                    <th>Role</th>
                    <th style="text-align: right;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                    <tr>
                        <td>
                            <div style="font-weight: 700;">{{ $user->name }} @if($user->id === auth()->id()) <span style="color: var(--text-dim); font-size: 0.7rem;">(আপনি)</span> @endif</div>
                            <div class="adm-mono" style="color: var(--text-dim);">{{ $user->email }}</div>
                        </td>
                        <td style="font-weight: 600;">{{ $user->phone ?? '—' }}</td>
                        <td style="font-size: 0.76rem; color: var(--text-muted); white-space: nowrap;">{{ $user->created_at->format('d M Y') }}</td>
                        <td>
                            <span class="adm-pill {{ $user->is_admin ? 'adm-pill-amber' : 'adm-pill-gray' }}">
                                {{ $user->is_admin ? '🛡 Admin' : 'Customer' }}
                            </span>
                        </td>
                        <td style="text-align: right;">
                            @if($user->id !== auth()->id())
                                <div class="adm-actions-row" style="justify-content: flex-end;">
                                    <form action="{{ route('admin.users.toggleAdmin', $user->id) }}" method="POST" class="m-0">
                                        @csrf
                                        <button type="submit" class="adm-btn {{ $user->is_admin ? 'adm-btn-amber' : 'adm-btn-secondary' }} adm-btn-xs">
                                            {{ $user->is_admin ? 'Remove Admin' : 'Make Admin' }}
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="m-0" data-confirm="ইউজার '{{ $user->name }}' স্থায়ীভাবে ডিলিট হবে। নিশ্চিত?">
                                        @csrf
                                        <button type="submit" class="adm-btn adm-btn-danger adm-btn-xs"><i data-lucide="trash-2" class="icon"></i></button>
                                    </form>
                                </div>
                            @else
                                <span style="font-size: 0.72rem; color: var(--text-dim);">—</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" style="padding: 2rem; text-align: center; color: var(--text-dim);">কোনো ইউজার পাওয়া যায়নি।</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    {{ $users->links() }}
</div>
@endsection
