@extends('layouts.app')

@section('title', 'Data Users')

@section('content')
    <div class="page-head">
        <h1>Data Users</h1>
        <a href="{{ route('users.create') }}" class="btn">+ Tambah User</a>
    </div>

    <div class="card">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Level</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $index => $user)
                    <tr>
                        <td>{{ $users->firstItem() + $index }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <span class="badge {{ $user->level == 'admin' ? 'badge-admin' : 'badge-user' }}">
                                {{ ucfirst($user->level) }}
                            </span>
                        </td>
                        <td>
                            <div class="actions">
                                <a href="{{ route('users.edit', $user) }}" class="btn btn-light btn-sm">Edit</a>

                                @if (! $user->is(auth()->user()))
                                    <form action="{{ route('users.destroy', $user) }}" method="POST"
                                          onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5">Belum ada data user.</td></tr>
                @endforelse
            </tbody>
        </table>

        <div class="pagination-container">
            {{ $users->links() }}
        </div>
    </div>
@endsection