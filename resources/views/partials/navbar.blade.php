<nav class="nav">
    <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">Dashboard</a>
    <a href="{{ route('kamar.index') }}" class="{{ request()->routeIs('kamar.*') ? 'active' : '' }}">Kamar</a>

    @if (Auth::check() && Auth::user()->level == 'admin')
        <a href="{{ route('users.index') }}" class="{{ request()->routeIs('users.*') ? 'active' : '' }}">Users</a>
    @endif
</nav>