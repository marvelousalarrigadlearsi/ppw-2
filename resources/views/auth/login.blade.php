
@extends('layouts.guest')

@section('title', 'Login')

@section('content')
<div class="auth-page">
    <aside class="auth-visual">
        <div class="brand">Kos<span>Jos.</span></div>

        <div class="visual-content">
            <div class="eyebrow">Kos management made simple</div>
            <h1>Kelola kos, lebih mudah.</h1>
            <p>Kelola data kamar, pantau ketersediaan, dan rapikan administrasi kos dalam satu tempat.</p>
        </div>

        <div class="visual-footer">© {{ date('Y') }} KosJos · Kelola kos dengan lebih praktis.</div>
    </aside>

    <main class="auth-main">
        <div class="auth-card">
            <div class="brand mobile-brand">Kos<span>Jos.</span></div>

            <h2>Selamat datang!</h2>
            <p class="subtitle">Masuk ke akunmu untuk melanjutkan ke dashboard KosJos.</p>

            @if (session('status'))
                <div class="alert" style="background:#e9f7ed;color:#245a3e;">
                    {{ session('status') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert">{{ session('error') }}</div>
            @endif

            @if ($errors->any())
                <div class="alert">
                    Email atau password tidak valid. Periksa kembali data loginmu.
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="field">
                    <label for="email">Alamat email</label>
                    <input
                        id="email"
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="nama@email.com"
                        autocomplete="email"
                        required
                        autofocus
                    >
                    @error('email')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="field">
                    <label for="password">Password</label>
                    <input
                        id="password"
                        type="password"
                        name="password"
                        placeholder="Masukkan password"
                        autocomplete="current-password"
                        required
                    >
                    @error('password')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <label style="display:flex;align-items:center;gap:9px;font-size:13px;color:#718078;margin:0 0 24px;">
                    <input type="checkbox" name="remember" value="1">
                    Ingat saya
                </label>

                <button type="submit" class="primary-btn">Masuk ke Dashboard →</button>
            </form>

            <div style="display:flex;align-items:center;gap:12px;margin:22px 0;color:#8b978f;font-size:12px;">
                <span style="flex:1;height:1px;background:#dce5de;"></span>
                atau
                <span style="flex:1;height:1px;background:#dce5de;"></span>
            </div>

            <a href="{{ route('google.redirect') }}"
               style="display:flex;align-items:center;justify-content:center;gap:10px;width:100%;padding:14px;border:1px solid #dce5de;border-radius:12px;background:white;color:#17251f;font-size:14px;font-weight:700;text-decoration:none;">
                <img src="https://www.gstatic.com/firebasejs/ui/2.0.0/images/auth/google.svg" width="18" alt="Google">
                Login dengan Google
            </a>

            <div class="auth-switch">
                Belum punya akun?
                <a href="{{ route('register') }}">Daftar sekarang</a>
            </div>
        </div>
    </main>
</div>
@endsection
