Claude


















Index.blade · PHP
 
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Kamar - KosJos</title>
    <link rel="stylesheet" href="{{ asset('css/kamar.css') }}">
</head>
<body>
 
<div class="container">
 
    <header class="header glass">
        <div class="brand">
            <div class="brand-icon">K</div>
            <div>
                <h1>KosJos</h1>
                <p>Pengelolaan Data Kamar Kos</p>
            </div>
        </div>
        <div class="header-text">
            Kelola dan pantau informasi kamar kos dengan mudah.
        </div>
    </header>
 
    @if (session('success'))
        <div class="success-message">
            {{ session('success') }}
        </div>
    @endif
 
    <section class="filter-box glass">
        <form action="{{ route('kamar.index') }}" method="GET" class="filter-form">
 
            <div class="search-wrapper">
                <span class="search-icon">⌕</span>
                <input
                    type="text"
                    name="search"
                    placeholder="Cari nomor kamar..."
                    value="{{ request('search') }}"
                >
            </div>
 
            <select name="tipe_kamar">
                <option value="">Semua Tipe</option>
                <option value="Standard" {{ request('tipe_kamar') == 'Standard' ? 'selected' : '' }}>
                    Standard
                </option>
                <option value="Deluxe" {{ request('tipe_kamar') == 'Deluxe' ? 'selected' : '' }}>
                    Deluxe
                </option>
            </select>
 
            <button type="submit" class="btn btn-search">Cari</button>
 
            <a href="{{ route('kamar.index') }}" class="btn btn-reset">Reset</a>
 
        </form>
    </section>
 
    <section class="stats">
 
        <div class="stat-card stat-total glass">
            <div class="stat-orb"></div>
            <div class="stat-content">
                <div class="stat-title">Total Kamar</div>
                <div class="stat-number">{{ $totalKamar }}</div>
                <div class="stat-description">Kamar terdaftar</div>
            </div>
        </div>
 
        <div class="stat-right">
 
            <div class="stat-card glass">
                <div class="small-orb"></div>
                <div class="stat-title">Total Harga</div>
                <div class="stat-value">
                    Rp {{ number_format($totalHarga, 0, ',', '.') }}
                </div>
            </div>
 
            <div class="stat-card glass">
                <div class="small-orb"></div>
                <div class="stat-title">Harga Tertinggi</div>
                <div class="stat-value">
                    Rp {{ number_format($hargaTertinggi ?? 0, 0, ',', '.') }}
                </div>
            </div>
 
            <div class="stat-card glass">
                <div class="small-orb"></div>
                <div class="stat-title">Harga Terendah</div>
                <div class="stat-value">
                    Rp {{ number_format($hargaTerendah ?? 0, 0, ',', '.') }}
                </div>
            </div>
 
        </div>
    </section>
 
    <section class="table-box glass">
 
        <div class="table-header">
            <div>
                <h2>Daftar Kamar</h2>
                <p>Informasi kamar yang tersedia pada KosJos</p>
            </div>
            <span class="room-count">{{ $kamars->total() }} data</span>
        </div>
 
        @if (Auth::check() && Auth::user()->level == 'admin')
            <div class="add-button-wrapper">
                <a href="{{ route('kamar.create') }}" class="btn btn-search">
                    + Tambah Kamar
                </a>
            </div>
        @endif
 
        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Foto</th>
                        <th>Nomor Kamar</th>
                        <th>Tipe</th>
                        <th>Harga</th>
                        <th>Fasilitas</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                        @if (Auth::check() && Auth::user()->level == 'admin')
                            <th>Aksi</th>
                        @endif
                    </tr>
                </thead>
 
                <tbody>
                    @forelse ($kamars as $index => $kamar)
                        <tr>
                            <td>{{ $kamars->firstItem() + $index }}</td>
 
                            <td class="photo-cell">
    @if ($kamar->foto)
        <img
               src="{{ asset('storage/foto-kamar/thumbnails/' . basename($kamar->foto)) }}"
            alt="Foto {{ $kamar->nomor_kamar }}"
            class="room-photo"
        >
    @else
        <div class="no-photo">Belum ada foto</div>
    @endif
</td>
 
                            <td>
                                <span class="room-number">
                                    {{ $kamar->nomor_kamar }}
                                </span>
                            </td>
 
                            <td>
                                <span class="badge {{ $kamar->tipe_kamar == 'Standard' ? 'badge-standard' : 'badge-deluxe' }}">
                                    {{ $kamar->tipe_kamar }}
                                </span>
                            </td>
 
                            <td>
                                <span class="price">
                                    Rp {{ number_format($kamar->harga, 0, ',', '.') }}
                                </span>
                            </td>
 
                            <td>{{ $kamar->fasilitas }}</td>
 
                            <td>
                                <span class="badge {{ $kamar->status == 'Tersedia' ? 'badge-available' : 'badge-filled' }}">
                                    {{ $kamar->status }}
                                </span>
                            </td>
 
                            <td>
                                {{ $kamar->created_at ? $kamar->created_at->format('d-m-Y H:i') : '-' }}
                            </td>
 
                            @if (Auth::check() && Auth::user()->level == 'admin')
                                <td>
                                    <div class="action-buttons">
                                        <a
                                            href="{{ route('kamar.edit', $kamar->id) }}"
                                            class="btn-edit"
                                        >
                                            Edit
                                        </a>
 
                                        <form
                                            action="{{ route('kamar.destroy', $kamar->id) }}"
                                            method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus kamar ini?')"
                                        >
                                            @csrf
                                            @method('DELETE')
 
                                            <button type="submit" class="btn-delete">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            @endif
                        </tr>
                    @empty
                        <tr>
                            <td colspan="{{ Auth::check() && Auth::user()->level == 'admin' ? 9 : 8 }}">
                                <div class="empty">
                                    <div class="empty-icon">⌕</div>
                                    <h3>Data kamar tidak ditemukan</h3>
                                    <p>Coba ubah kata pencarian atau filter tipe kamar.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
 
        <div class="pagination-container">
            {{ $kamars->links() }}
        </div>
 
    </section>
</div>
 
</body>
</html>
 

