@csrf

<div class="form-group">
    <label for="name">Nama</label>
    <input type="text" id="name" name="name" value="{{ old('name', $user->name ?? '') }}" required>
    @error('name') <div class="error">{{ $message }}</div> @enderror
</div>

<div class="form-group">
    <label for="email">Email</label>
    <input type="email" id="email" name="email" value="{{ old('email', $user->email ?? '') }}" required>
    @error('email') <div class="error">{{ $message }}</div> @enderror
</div>

<div class="form-group">
    <label for="level">Level</label>
    <select id="level" name="level" required>
        @foreach (['user' => 'User', 'admin' => 'Admin'] as $value => $label)
            <option value="{{ $value }}" {{ old('level', $user->level ?? 'user') == $value ? 'selected' : '' }}>
                {{ $label }}
            </option>
        @endforeach
    </select>
    @error('level') <div class="error">{{ $message }}</div> @enderror
</div>

<div class="form-group">
    <label for="password">Password</label>
    <input type="password" id="password" name="password" autocomplete="new-password" {{ isset($user) ? '' : 'required' }}>
    @if (isset($user))
        <div class="hint">Kosongkan jika tidak ingin mengubah password.</div>
    @endif
    @error('password') <div class="error">{{ $message }}</div> @enderror
</div>

<div class="form-group">
    <label for="password_confirmation">Konfirmasi Password</label>
    <input type="password" id="password_confirmation" name="password_confirmation" autocomplete="new-password" {{ isset($user) ? '' : 'required' }}>
</div>

<div class="form-actions">
    <button type="submit" class="btn">Simpan</button>
    <a href="{{ route('users.index') }}" class="btn btn-light">Batal</a>
</div>