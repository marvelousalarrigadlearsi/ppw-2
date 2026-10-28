
@extends('layouts.guest')

@section('title', 'Register')

@section('content')
<div class="auth-page">
    <aside class="auth-visual">
        <div class="brand">Kos<span>Jos.</span></div>

        <div class="visual-content">
            <div class="eyebrow">Your space, under control</div>
            <h1>Mulai kelola kos dengan rapi.</h1>
            <p>Buat akun KosJos dan nikmati pengelolaan data kamar yang lebih praktis, terstruktur, dan efisien.</p>
        </div>

        <div class="visual-footer">© {{ date('Y') }} KosJos · Kelola kos dengan lebih praktis.</div>
    </aside>

    <main class="auth-main">
        <div class="auth-card">
            <div class="brand mobile-brand">Kos<span>Jos.</span></div>

            <h2>Buat akun baru</h2>
            <p class="subtitle">Daftar untuk mulai menggunakan dashboard KosJos.</p>

            @if ($errors->any())
                <div class="alert">
                    <ul style="padding-left:18px;margin:0;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="field">
                    <label for="name">Nama lengkap</label>
                    <input
                        id="name"
                        type="text"
                        name="name"
                        value="{{ old('name') }}"
                        placeholder="Masukkan nama lengkap"
                        autocomplete="name"
                        required
                        autofocus
                    >
                    @error('name')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

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
                        placeholder="Minimal 8 karakter"
                        autocomplete="new-password"
                        required
                    >
                    @error('password')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="field">
                    <label for="password_confirmation">Konfirmasi password</label>
                    <input
                        id="password_confirmation"
                        type="password"
                        name="password_confirmation"
                        placeholder="Ulangi password"
                        autocomplete="new-password"
                        required
                    >
                </div>

                <button type="submit" class="primary-btn">Buat Akun →</button>
            </form>

            <div class="auth-switch">
                Sudah punya akun?
                <a href="{{ route('login') }}">Masuk di sini</a>
            </div>
        </div>
    </main>
</div>
@endsection
