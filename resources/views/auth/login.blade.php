@extends('layouts.app')

@section('title', 'Login or Create Account | RosTop')
@section('meta_description', 'Sign in to RosTop (rostop.com) with Super Admin credentials or customer OTP.')

@push('styles')
<style>
    .auth-wrap {
        min-height: 60vh;
        display: flex;
        align-items: flex-start;
        justify-content: center;
        padding: 2.5rem 0 4rem;
    }
    .auth-card {
        width: 100%;
        max-width: 440px;
        background: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 20px;
        padding: 1.75rem 1.5rem 1.5rem;
        box-shadow: var(--shadow-lg);
    }
    .auth-logo-row { display: flex; align-items: center; justify-content: space-between; margin-bottom: 1rem; }
    .auth-brand-link { display: inline-flex; align-items: center; gap: 0.6rem; text-decoration: none; color: inherit; }
    
    .auth-tabs {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 6px;
        background: var(--bg-surface);
        padding: 4px;
        border-radius: 12px;
        border: 1px solid var(--border-color);
        margin-bottom: 1.25rem;
    }
    .auth-tab-btn {
        padding: 8px 10px;
        font-size: 0.78rem;
        font-weight: 700;
        border-radius: 9px;
        border: none;
        background: transparent;
        color: var(--text-muted);
        cursor: pointer;
        transition: all 0.15s ease;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
    }
    .auth-tab-btn.active {
        background: var(--bg-card);
        color: var(--text-main);
        box-shadow: var(--shadow-sm);
    }
    .auth-tab-btn.active.is-admin-tab {
        color: var(--vb-orange);
    }

    .auth-title { font-size: 1.35rem; font-weight: 800; color: var(--text-main); letter-spacing: -0.02em; margin-bottom: 0.25rem; }
    .auth-sub { font-size: 0.85rem; color: var(--text-muted); margin-bottom: 1.25rem; line-height: 1.6; }
    .auth-field-label { font-size: 0.78rem; font-weight: 700; color: var(--text-secondary); margin-bottom: 0.35rem; display: block; }
    .auth-input { width: 100%; min-height: 52px; font-size: 1rem !important; padding: 0.75rem 1rem; }
    .auth-detect-hint { font-size: 0.75rem; min-height: 1.1rem; margin-top: 0.4rem; color: var(--text-dim); font-weight: 600; }
    .auth-detect-hint.is-email { color: #38BDF8; }
    .auth-detect-hint.is-phone { color: var(--primary); }
    .auth-detect-hint.is-admin { color: var(--vb-orange); }
    .auth-otp-input { letter-spacing: 0.6em; text-align: center; font-size: 1.5rem !important; font-weight: 800; }
    .auth-btn-main { width: 100%; min-height: 52px; margin-top: 0.9rem; }
    .auth-alt-row { display: flex; align-items: center; gap: 0.75rem; margin: 1.25rem 0 0.9rem; }
    .auth-alt-line { flex: 1; height: 1px; background: var(--border-color); }
    .auth-alt-text { font-size: 0.72rem; color: var(--text-dim); font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; }
    .auth-google-btn {
        width: 100%; min-height: 50px; display: inline-flex; align-items: center; justify-content: center; gap: 0.55rem;
        background: var(--bg-surface); border: 1px solid var(--border-color); border-radius: 12px;
        color: var(--text-dim); font-weight: 700; font-size: 0.9rem; cursor: not-allowed; opacity: 0.75;
    }
    .auth-google-chip { font-size: 0.62rem; font-weight: 800; padding: 2px 8px; border-radius: 999px; background: rgba(245,158,11,0.15); color: var(--accent-amber); border: 1px solid rgba(245,158,11,0.3); }
    .auth-change-link { display: inline-flex; align-items: center; gap: 0.3rem; font-size: 0.8rem; font-weight: 700; color: var(--primary); text-decoration: none; margin-top: 0.75rem; }
    .auth-otp-meta { font-size: 0.8rem; color: var(--text-muted); text-align: center; margin-bottom: 1rem; }
    .auth-otp-meta strong { color: var(--text-main); }
    .auth-note { font-size: 0.72rem; color: var(--text-dim); text-align: center; margin-top: 1rem; line-height: 1.6; }
</style>
@endpush

@section('content')
<div class="container auth-wrap">
    <div class="auth-card">

        <div class="auth-logo-row">
            <a href="{{ route('home') }}" class="auth-brand-link">
                <div class="brand-icon"><i data-lucide="zap" class="icon"></i></div>
                <span class="brand-title">Ros<span style="color: var(--primary);">Top</span></span>
            </a>
            <a href="{{ route('home') }}" style="font-size: 0.78rem; font-weight: 700; color: var(--text-muted); text-decoration: none; display: inline-flex; align-items: center; gap: 4px;">
                <i data-lucide="arrow-left" class="icon" style="width:14px;height:14px;"></i> স্টোরে ফিরুন
            </a>
        </div>

        @if(!$otpUser)
            <!-- Mode Switcher Tabs -->
            <div class="auth-tabs" role="tablist">
                <button type="button" class="auth-tab-btn active" id="tab-otp-btn" role="tab" aria-selected="true">
                    <i data-lucide="smartphone" class="icon" style="width:14px;height:14px;"></i>
                    <span>কাস্টমার (OTP)</span>
                </button>
                <button type="button" class="auth-tab-btn is-admin-tab" id="tab-admin-btn" role="tab" aria-selected="false">
                    <i data-lucide="shield" class="icon" style="width:14px;height:14px;"></i>
                    <span>সুপার এডমিন</span>
                </button>
            </div>

            {{-- ================= TAB 1: CUSTOMER OTP STEP 1 ================= --}}
            <div id="auth-otp-pane">
                <h1 class="auth-title">লগইন / সাইন আপ</h1>
                <p class="auth-sub">
                    আপনার মোবাইল নাম্বার বা ইমেইল দিন — আমরা OTP পাঠিয়ে দেবো। নতুন হলে অ্যাকাউন্ট নিজেই তৈরি হয়ে যাবে।
                </p>

                <form action="{{ route('login.otp') }}" method="POST">
                    @csrf
                    <label class="auth-field-label" for="identifier">Mobile Number বা E-mail</label>
                    <input type="text"
                           id="identifier"
                           name="identifier"
                           class="form-control auth-input"
                           placeholder="e.g. 01712345678 অথবা you@gmail.com"
                           value="{{ old('identifier') }}"
                           autocomplete="username"
                           inputmode="text"
                           autofocus
                           required>
                    <div class="auth-detect-hint" id="auth-detect-hint"></div>

                    <button type="submit" class="btn btn-primary auth-btn-main">
                        <span>এগিয়ে যান</span>
                        <i data-lucide="arrow-right" class="icon" style="width:16px;height:16px;"></i>
                    </button>
                </form>
            </div>

            {{-- ================= TAB 2: SUPER ADMIN PASSWORD LOGIN ================= --}}
            <div id="auth-admin-pane" style="display: none;">
                <h1 class="auth-title">সুপার এডমিন লগইন</h1>
                <p class="auth-sub">
                    রোস্টপ ম্যানেজমেন্ট পোর্টালে সরাসরি পাসওয়ার্ড দিয়ে লগইন করুন।
                </p>

                <form action="{{ route('login.password') }}" method="POST">
                    @csrf
                    <div style="background: rgba(255, 140, 0, 0.08); border: 1px solid rgba(255, 140, 0, 0.25); border-radius: 10px; padding: 10px 12px; margin-bottom: 1rem; font-size: 0.78rem; color: var(--vb-orange); display: flex; align-items: center; gap: 8px;">
                        <i data-lucide="shield-check" class="icon" style="width:16px;height:16px;flex-shrink:0;"></i>
                        <span>সুপার এডমিন তথ্য: <strong>admin</strong> / <strong>admin1234</strong></span>
                    </div>

                    <div style="margin-bottom: 0.85rem;">
                        <label class="auth-field-label" for="admin-identifier">ইউজারনেম বা ইমেইল</label>
                        <input type="text"
                               id="admin-identifier"
                               name="identifier"
                               class="form-control auth-input"
                               placeholder="admin"
                               value="{{ old('identifier', 'admin') }}"
                               autocomplete="username"
                               required>
                    </div>

                    <div style="margin-bottom: 0.85rem;">
                        <label class="auth-field-label" for="admin-password">পাসওয়ার্ড</label>
                        <input type="password"
                               id="admin-password"
                               name="password"
                               class="form-control auth-input"
                               placeholder="••••••••"
                               value="admin1234"
                               autocomplete="current-password"
                               required>
                    </div>

                    <button type="button" class="btn btn-sm w-100" style="margin-bottom: 0.75rem; background: rgba(255, 140, 0, 0.1); border: 1px dashed rgba(255, 140, 0, 0.35); color: var(--vb-orange); font-weight: 700; font-size: 0.78rem; border-radius: 8px; padding: 6px; display: inline-flex; align-items: center; justify-content: center; gap: 5px;" onclick="document.getElementById('admin-identifier').value='admin'; document.getElementById('admin-password').value='admin1234';">
                        <i data-lucide="key-round" class="icon" style="width:13px;height:13px;"></i>
                        <span>এডমিন তথ্য বসান (admin / admin1234)</span>
                    </button>

                    <button type="submit" class="btn btn-primary auth-btn-main" style="margin-top: 0; background: linear-gradient(135deg, var(--vb-orange), #ea580c); border-color: var(--vb-orange);">
                        <i data-lucide="shield" class="icon" style="width:16px;height:16px;"></i>
                        <span>এডমিন প্যানেলে লগইন করুন</span>
                    </button>
                </form>
            </div>

        @else
            {{-- ================= STEP 2: OTP VERIFICATION ================= --}}
            <h1 class="auth-title">OTP বা পাসওয়ার্ড দিন</h1>
            <div class="auth-otp-meta">
                <strong>{{ $identifierDisplay }}</strong> এর জন্য ভেরিফিকেশন কোড দিন
                <div style="font-size:0.75rem; color:var(--text-dim); margin-top:0.25rem;">
                    (ডেমো কোড: <strong style="color:var(--primary);">1234</strong> অথবা পাসওয়ার্ড: <strong style="color:var(--vb-orange);">admin1234</strong>)
                </div>
            </div>

            <form action="{{ route('login.verify') }}" method="POST">
                @csrf
                <input type="text"
                       id="otp"
                       name="otp"
                       class="form-control auth-input auth-otp-input"
                       placeholder="••••"
                       maxlength="20"
                       autocomplete="one-time-code"
                       autofocus
                       required>

                <div style="display: flex; gap: 6px; margin-top: 0.45rem;">
                    <button type="button" class="btn btn-sm" style="flex:1; background: rgba(16, 185, 129, 0.1); border: 1px dashed rgba(16, 185, 129, 0.35); color: var(--primary); font-weight: 700; font-size: 0.76rem; border-radius: 8px; padding: 6px; display: inline-flex; align-items: center; justify-content: center; gap: 4px;" onclick="document.getElementById('otp').value='1234';">
                        <i data-lucide="key-round" class="icon" style="width:12px;height:12px;"></i>
                        <span>OTP 1234</span>
                    </button>
                    <button type="button" class="btn btn-sm" style="flex:1; background: rgba(255, 140, 0, 0.1); border: 1px dashed rgba(255, 140, 0, 0.35); color: var(--vb-orange); font-weight: 700; font-size: 0.76rem; border-radius: 8px; padding: 6px; display: inline-flex; align-items: center; justify-content: center; gap: 4px;" onclick="document.getElementById('otp').value='admin1234';">
                        <i data-lucide="shield" class="icon" style="width:12px;height:12px;"></i>
                        <span>admin1234</span>
                    </button>
                </div>

                <button type="submit" class="btn btn-primary auth-btn-main">
                    <span>লগইন করুন</span>
                    <i data-lucide="log-in" class="icon" style="width:16px;height:16px;"></i>
                </button>
            </form>

            <div class="text-center">
                <a href="{{ route('login.reset') }}" class="auth-change-link">
                    <i data-lucide="edit-2" class="icon" style="width:13px;height:13px;"></i>
                    <span>নাম্বার/ইমেইল পরিবর্তন করুন</span>
                </a>
            </div>
        @endif

        <div class="auth-alt-row">
            <div class="auth-alt-line"></div>
            <span class="auth-alt-text">অথবা</span>
            <div class="auth-alt-line"></div>
        </div>

        <button type="button" class="auth-google-btn" disabled title="Google Login শীঘ্রই আসছে">
            <svg width="17" height="17" viewBox="0 0 48 48" aria-hidden="true"><path fill="#FFC107" d="M43.6 20.1H42V20H24v8h11.3c-1.6 4.7-6.1 8-11.3 8-6.6 0-12-5.4-12-12s5.4-12 12-12c3.1 0 5.9 1.2 8 3l5.7-5.7C34 6.1 29.3 4 24 4 13 4 4 13 4 24s9 20 20 20 20-9 20-20c0-1.3-.1-2.6-.4-3.9z"/><path fill="#FF3D00" d="M6.3 14.7l6.6 4.8C14.7 15.1 19 12 24 12c3.1 0 5.9 1.2 8 3l5.7-5.7C34 6.1 29.3 4 24 4 16.3 4 9.7 8.3 6.3 14.7z"/><path fill="#4CAF50" d="M24 44c5.2 0 9.9-2 13.4-5.2l-6.2-5.2C29.2 35.1 26.7 36 24 36c-5.2 0-9.6-3.3-11.3-8l-6.5 5C9.5 39.6 16.2 44 24 44z"/><path fill="#1976D2" d="M43.6 20.1H42V20H24v8h11.3c-.8 2.3-2.3 4.3-4.1 5.6l6.2 5.2C41 35.4 44 30.2 44 24c0-1.3-.1-2.6-.4-3.9z"/></svg>
            <span>Google দিয়ে লগইন</span>
            <span class="auth-google-chip">শীঘ্রই আসছে</span>
        </button>

        <p class="auth-note">
            লগইন করলেই আপনি আমাদের সার্ভিস শর্তাবলী মেনে নিচ্ছেন। ক্রেডেনশিয়াল কাউকে শেয়ার করবেন না।
        </p>

    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Tabs switching
    var tabOtp = document.getElementById('tab-otp-btn');
    var tabAdmin = document.getElementById('tab-admin-btn');
    var paneOtp = document.getElementById('auth-otp-pane');
    var paneAdmin = document.getElementById('auth-admin-pane');

    if (tabOtp && tabAdmin && paneOtp && paneAdmin) {
        tabOtp.addEventListener('click', function () {
            tabOtp.classList.add('active');
            tabAdmin.classList.remove('active');
            paneOtp.style.display = '';
            paneAdmin.style.display = 'none';
        });

        tabAdmin.addEventListener('click', function () {
            tabAdmin.classList.add('active');
            tabOtp.classList.remove('active');
            paneAdmin.style.display = '';
            paneOtp.style.display = 'none';
        });
    }

    // Hint detection for OTP identifier
    var input = document.getElementById('identifier');
    var hint = document.getElementById('auth-detect-hint');
    if (!input || !hint) return;

    function updateHint() {
        var v = input.value.trim();
        hint.classList.remove('is-email', 'is-phone', 'is-admin');
        if (v === '') { hint.textContent = ''; return; }
        if (v.toLowerCase() === 'admin') {
            hint.textContent = '🛡 সুপার এডমিন অ্যাকাউন্ট চিহ্নিত হয়েছে';
            hint.classList.add('is-admin');
        } else if (v.indexOf('@') !== -1) {
            hint.textContent = '✉ ইমেইল হিসেবে ধরা হয়েছে';
            hint.classList.add('is-email');
        } else if (/\d/.test(v)) {
            hint.textContent = '☏ মোবাইল নাম্বার হিসেবে ধরা হয়েছে';
            hint.classList.add('is-phone');
        } else {
            hint.textContent = '';
        }
    }
    input.addEventListener('input', updateHint);
    updateHint();
});
</script>
@endpush
