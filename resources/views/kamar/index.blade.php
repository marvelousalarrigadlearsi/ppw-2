<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KosJos - Data Kamar</title>
    <link rel="stylesheet" href="{{ asset('css/kamar.css') }}">
</head>

<body>

<div class="container">

    <header class="header glass">
        <div class="brand">
            <div class="brand-icon">
                K
            </div>

            <div>
                <h1>KosJos</h1>
                <p>Pengelolaan Data Kamar Kos</p>
            </div>
        </div>

        <div class="header-text">
            Kelola dan pantau informasi kamar kos dengan mudah.
        </div>
    </header>


    <section class="filter-box glass">
        <form
            action="{{ route('kamar.index') }}"
            method="GET"
            class="filter-form"
        >

            <div class="search-wrapper">
                <span class="search-icon">⌕</span>

                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Cari nomor kamar..."
                >
            </div>


            <select name="tipe_kamar">
                <option value="">
                    Semua Tipe
                </option>

                <option
                    value="Standard"
                    {{ request('tipe_kamar') == 'Standard' ? 'selected' : '' }}
                >
                    Standard
                </option>

                <option
                    value="Deluxe"
                    {{ request('tipe_kamar') == 'Deluxe' ? 'selected' : '' }}
                >
                    Deluxe
                </option>
            </select>


            <button
                type="submit"
                class="btn btn-search"
            >
                Cari
            </button>


            <a
                href="{{ route('kamar.index') }}"
                class="btn btn-reset"
            >
                Reset
            </a>

        </form>
    </section>


    <section class="stats">

        <div class="stat-card stat-total glass">

            <div class="stat-content">

                <span class="stat-title">
                    Total Kamar
                </span>

                <strong class="stat-number">
                    {{ $totalKamar }}
                </strong>

                <span class="stat-description">
                    Kamar terdaftar
                </span>

            </div>

            <div class="stat-orb"></div>

        </div>


        <div class="stat-right">

            <div class="stat-card glass">

                <div class="stat-content">

                    <span class="stat-title">
                        Total Harga
                    </span>

                    <strong class="stat-value">
                        Rp {{ number_format($totalHarga, 0, ',', '.') }}
                    </strong>

                </div>

                <div class="small-orb"></div>

            </div>


            <div class="stat-card glass">

                <div class="stat-content">

                    <span class="stat-title">
                        Harga Tertinggi
                    </span>

                    <strong class="stat-value">
                        Rp {{ number_format($hargaTertinggi, 0, ',', '.') }}
                    </strong>

                </div>

                <div class="small-orb"></div>

            </div>


            <div class="stat-card glass">

                <div class="stat-content">

                    <span class="stat-title">
                        Harga Terendah
                    </span>

                    <strong class="stat-value">
                        Rp {{ number_format($hargaTerendah, 0, ',', '.') }}
                    </strong>

                </div>

                <div class="small-orb"></div>

            </div>

        </div>

    </section>


    <section class="table-box glass">

        <div class="table-header">

            <div>
                <h2>Daftar Kamar</h2>

                <p>
                    Informasi kamar yang tersedia pada KosJos
                </p>
            </div>

            <div class="room-count">
                {{ $kamars->count() }} data
            </div>

        </div>


        <div class="add-button-wrapper">

            <a
                href="{{ route('kamar.create') }}"
                class="btn btn-add"
            >
                Tambah Kamar
            </a>

        </div>


        @if ($kamars->count() > 0)

            <div class="table-wrapper">

                <table>

                    <thead>

                        <tr>

                            <th>No</th>

                            <th>Nomor Kamar</th>

                            <th>Tipe</th>

                            <th>Harga</th>

                            <th>Fasilitas</th>

                            <th>Status</th>

                            <th>Aksi</th>

                        </tr>

                    </thead>


                    <tbody>

                        @foreach ($kamars as $index => $kamar)

                            <tr>

                                <td>
                                    {{ $index + 1 }}
                                </td>


                                <td>

                                    <span class="room-number">
                                        {{ $kamar->nomor_kamar }}
                                    </span>

                                </td>


                                <td>

                                    @if ($kamar->tipe_kamar === 'Standard')

                                        <span class="badge badge-standard">
                                            Standard
                                        </span>

                                    @else

                                        <span class="badge badge-deluxe">
                                            Deluxe
                                        </span>

                                    @endif

                                </td>


                                <td>

                                    <span class="price">
                                        Rp {{ number_format($kamar->harga, 0, ',', '.') }}
                                    </span>

                                </td>


                                <td>
                                    {{ $kamar->fasilitas }}
                                </td>


                                <td>

                                    @if ($kamar->status === 'Tersedia')

                                        <span class="badge badge-available">
                                            Tersedia
                                        </span>

                                    @else

                                        <span class="badge badge-filled">
                                            Terisi
                                        </span>

                                    @endif

                                </td>


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
                                        >

                                            @csrf

                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="btn-delete"
                                            >
                                                Hapus
                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>


        @else

            <div class="empty">

                <div class="empty-icon">
                    ⌕
                </div>

                <h3>
                    Data tidak ditemukan
                </h3>

                <p>
                    Tidak ada kamar yang sesuai dengan pencarian.
                </p>

            </div>

        @endif

    </section>

</div>


<script src="{{ asset('js/kamar.js') }}"></script>

</body>
</html>