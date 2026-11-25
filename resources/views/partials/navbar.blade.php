<nav class="nav">
    <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">Dashboard</a>
    <a href="{{ route('kamar.index') }}" class="{{ request()->routeIs('kamar.*') ? 'active' : '' }}">Kamar</a>

    @if (Auth::check() && Auth::user()->level == 'admin')
        <a href="{{ route('users.index') }}" class="{{ request()->routeIs('users.*') ? 'active' : '' }}">Users</a>

        {{-- Tugas 4: badge jumlah notifikasi belum dibaca + tombol "Tandai semua dibaca" (khusus admin). --}}
        @php($belumDibaca = Auth::user()->unreadNotifications()->count())

        <a href="{{ route('dashboard') }}#notifikasi">
            Notifikasi
            @if ($belumDibaca > 0)
                <span style="display:inline-block;min-width:20px;padding:2px 7px;margin-left:4px;border-radius:999px;background:#b3402f;color:#fff;font-size:11px;font-weight:700;text-align:center;">{{ $belumDibaca }}</span>
            @endif
        </a>

        @if ($belumDibaca > 0)
            <form method="POST" action="{{ route('notifikasi.baca') }}" style="display:inline;margin:0;">
                @csrf
                <button type="submit" style="border:0;background:none;color:#214e39;font-size:13px;font-weight:600;cursor:pointer;padding:9px 6px;text-decoration:underline;">Tandai semua dibaca</button>
            </form>
        @endif
    @endif
</nav>
