<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <title>@yield('title', 'Admin Panel | RosTop')</title>

    <link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@400;500;600;700&family=Inter:wght@300;400;500;600;700;800;900&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/vendor/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}?v={{ time() }}">
</head>
<body class="adm-body">

    <!-- Top Bar -->
    <header class="adm-topbar">
        <div class="adm-topbar-left">
            <button type="button" class="adm-icon-btn d-lg-none" id="adm-menu-btn" aria-label="Open admin menu">
                <i data-lucide="menu" class="icon"></i>
            </button>
            <a href="{{ route('admin.dashboard') }}" class="adm-brand">
                <div class="brand-icon"><i data-lucide="zap" class="icon"></i></div>
                <span>RosTop <strong>Admin</strong></span>
            </a>
        </div>
        <div class="adm-topbar-right">
            <a href="{{ route('home') }}" class="adm-toplink" title="View live site">
                <i data-lucide="globe" class="icon"></i>
                <span class="d-none d-sm-inline">View Site</span>
            </a>
            <div class="adm-user-chip" title="{{ auth()->user()->email }}">
                <span class="adm-user-avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</span>
                <span class="adm-user-name d-none d-sm-inline">{{ auth()->user()->name }}</span>
            </div>
            <form action="{{ route('logout') }}" method="POST" class="m-0">
                @csrf
                <button type="submit" class="adm-icon-btn" title="Logout" aria-label="Logout">
                    <i data-lucide="log-out" class="icon"></i>
                </button>
            </form>
        </div>
    </header>

    <div class="adm-shell">
        <!-- Sidebar -->
        @include('admin.partials.sidebar')

        <!-- Main Content -->
        <main class="adm-main">
            @if(session('success'))
                <div class="flash-message flash-success" style="margin-bottom: 1rem;">
                    <i data-lucide="check-circle" class="icon"></i>
                    <div>{{ session('success') }}</div>
                </div>
            @endif
            @if(session('error'))
                <div class="flash-message flash-error" style="margin-bottom: 1rem;">
                    <i data-lucide="alert-circle" class="icon"></i>
                    <div>{{ session('error') }}</div>
                </div>
            @endif
            @if($errors->any())
                <div class="flash-message flash-error" style="margin-bottom: 1rem;">
                    <i data-lucide="alert-triangle" class="icon"></i>
                    <div>
                        @foreach($errors->all() as $err)
                            <div>{{ $err }}</div>
                        @endforeach
                    </div>
                </div>
            @endif

            @yield('content')
        </main>
    </div>

    <script src="{{ asset('js/vendor/lucide.min.js') }}" defer></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            if (window.lucide) lucide.createIcons();

            var menuBtn = document.getElementById('adm-menu-btn');
            var sidebar = document.getElementById('adm-sidebar');
            var overlay = document.getElementById('adm-overlay');

            function openSidebar() { sidebar && sidebar.classList.add('open'); overlay && overlay.classList.add('show'); }
            function closeSidebar() { sidebar && sidebar.classList.remove('open'); overlay && overlay.classList.remove('show'); }

            if (menuBtn) menuBtn.addEventListener('click', openSidebar);
            if (overlay) overlay.addEventListener('click', closeSidebar);

            // Confirm before delete
            document.querySelectorAll('form[data-confirm]').forEach(function (form) {
                form.addEventListener('submit', function (e) {
                    if (!window.confirm(form.getAttribute('data-confirm') || 'Are you sure?')) {
                        e.preventDefault();
                    }
                });
            });
        });
    </script>
    @stack('scripts')
</body>
</html>
