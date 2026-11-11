<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - KosJos</title>
    <style>
        * { box-sizing: border-box; }
        body { margin: 0; font-family: Inter, "Segoe UI", Arial, sans-serif; color: #1c2a22; background: #f5f7f5; }
        .topbar { background: white; border-bottom: 1px solid #e6ebe7; padding: 18px 5%; display: flex; align-items: center; justify-content: space-between; gap: 20px; flex-wrap: wrap; }
        .brand { font-size: 25px; font-weight: 800; letter-spacing: -1px; }
        .brand span { color: #40815d; }
        .nav { display: flex; gap: 6px; flex-wrap: wrap; }
        .nav a { text-decoration: none; color: #4a5a50; font-size: 14px; font-weight: 600; padding: 9px 14px; border-radius: 10px; }
        .nav a:hover, .nav a.active { background: #e9f1ec; color: #214e39; }
        .topbar-right { display: flex; align-items: center; gap: 18px; }
        .user-name { font-size: 13px; color: #68766d; }
        .logout { border: 1px solid #dce5de; background: white; padding: 10px 15px; border-radius: 10px; cursor: pointer; font-weight: 600; }
        .container { max-width: 1100px; padding: 36px 24px; margin: auto; }
        .card { background: white; border: 1px solid #e8ede9; border-radius: 18px; padding: 26px; }
        .page-head { display: flex; justify-content: space-between; align-items: center; gap: 12px; margin-bottom: 20px; flex-wrap: wrap; }
        .page-head h1 { margin: 0; font-size: 24px; letter-spacing: -.5px; }
        .btn { display: inline-block; background: #214e39; color: white; text-decoration: none; padding: 11px 16px; border-radius: 10px; font-size: 13px; font-weight: 700; border: 0; cursor: pointer; }
        .btn-light { background: #eef3ef; color: #214e39; }
        .btn-danger { background: #b3402f; }
        .btn-sm { padding: 7px 12px; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; font-size: 14px; }
        th, td { text-align: left; padding: 13px 10px; border-bottom: 1px solid #eef2ef; }
        th { color: #718078; font-size: 12px; text-transform: uppercase; letter-spacing: .5px; }
        .badge { display: inline-block; padding: 4px 10px; border-radius: 999px; font-size: 12px; font-weight: 700; }
        .badge-admin { background: #dcefe3; color: #1e4935; }
        .badge-user { background: #eef0f3; color: #4a5560; }
        .actions { display: flex; gap: 8px; align-items: center; }
        .alert { padding: 13px 16px; border-radius: 12px; margin-bottom: 18px; font-size: 14px; }
        .alert-success { background: #e3f3e8; color: #1e4935; }
        .alert-error { background: #fbe6e2; color: #8a2e20; }
        .form-group { margin-bottom: 18px; }
        label { display: block; font-size: 13px; font-weight: 600; margin-bottom: 7px; }
        input, select { width: 100%; padding: 12px 14px; border: 1px solid #dce5de; border-radius: 10px; font-size: 14px; font-family: inherit; background: white; }
        .error { color: #b3402f; font-size: 12px; margin-top: 6px; }
        .hint { color: #8b978f; font-size: 12px; margin-top: 6px; }
        .form-actions { display: flex; gap: 10px; margin-top: 8px; }
        .form-card { max-width: 560px; }
        .pagination-container { margin-top: 18px; }
        @media(max-width: 650px) { .user-name { display: none; } .container { padding: 24px 16px; } }
    </style>
</head>
<body>
    <header class="topbar">
        <div class="brand">Kos<span>Jos.</span></div>

        @include('partials.navbar')

        <div class="topbar-right">
            <span class="user-name">{{ auth()->user()->name }}</span>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="logout" type="submit">Keluar ↗</button>
            </form>
        </div>
    </header>

    <main class="container">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if (session('error'))
            <div class="alert alert-error">{{ session('error') }}</div>
        @endif

        @yield('content')
    </main>
</body>
</html>