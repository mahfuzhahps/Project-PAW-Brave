<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="color-scheme" content="light">
    <title>@yield('title', 'Dashboard Admin | BRAVE')</title>

    @fonts
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('assets/brave-admin/admin.css') }}">
</head>
<body class="brave-admin">
    <div class="admin-shell">
        <header class="admin-header">
            <a class="admin-brand" href="{{ route('preview.admin.dashboard') }}" aria-label="BRAVE - Dashboard Admin">
                <img class="admin-brand-symbol" src="{{ asset('assets/brave-admin/logo-simpul-kampus.svg') }}" alt="" width="64" height="64">
                <span class="admin-brand-copy">
                    <strong>BRAVE</strong>
                    <span>Brawijaya Event</span>
                </span>
            </a>

            <div class="admin-account">
                <div class="admin-identity">
                    <span class="admin-avatar" aria-hidden="true">A</span>
                    <span>Admin</span>
                </div>
                <button class="admin-button admin-button-logout" type="button" disabled>
                    @include('admin.partials.icon', ['name' => 'logout'])
                    Keluar
                </button>
            </div>
        </header>

        <aside class="admin-sidebar">
            <div class="admin-sidebar-art" aria-hidden="true">
                <span class="sidebar-disc sidebar-disc-top"></span>
                <span class="sidebar-disc sidebar-disc-bottom"></span>
                <span class="sidebar-ring sidebar-ring-one"></span>
                <span class="sidebar-ring sidebar-ring-two"></span>
            </div>

            <nav class="admin-nav" aria-label="Navigasi Admin">
                <a
                    class="admin-nav-item {{ request()->routeIs('preview.admin.dashboard') ? 'is-active' : '' }}"
                    href="{{ route('preview.admin.dashboard') }}"
                    @if (request()->routeIs('preview.admin.dashboard')) aria-current="page" @endif
                >
                    <span class="admin-nav-icon">
                        @include('admin.partials.icon', ['name' => 'grid'])
                    </span>
                    <span>Dashboard</span>
                </a>

                <a
                    class="admin-nav-item {{ request()->routeIs('preview.admin.events.*') ? 'is-active' : '' }}"
                    href="{{ route('preview.admin.events.index') }}"
                    @if (request()->routeIs('preview.admin.events.*')) aria-current="page" @endif
                >
                    <span class="admin-nav-icon">
                        @include('admin.partials.icon', ['name' => 'calendar'])
                    </span>
                    <span>Kelola Event</span>
                </a>
            </nav>
        </aside>

        <main class="admin-main" id="main-content">
            @yield('content')
        </main>
    </div>
</body>
</html>
