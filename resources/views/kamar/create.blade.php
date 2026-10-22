<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Kamar - KosJos</title>

    <link rel="stylesheet" href="{{ asset('css/kamar.css') }}">
</head>
<body>

    <div class="create-kamar-container">

        <div class="create-kamar-header">
            <h1>Tambah Kamar Baru</h1>
            <p>Lengkapi informasi kamar untuk menambahkan data ke sistem KosJos.</p>
        </div>

        @if ($errors->any())
            <div class="alert-error">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('kamar.store') }}" method="POST" class="create-kamar-form">
            @csrf

            <div class="form-group">
                <label for="nomor_kamar">Nomor Kamar</label>
                <input
                    type="text"
                    id="nomor_kamar"
                    name="nomor_kamar"
                    value="{{ old('nomor_kamar') }}"
                    placeholder="Contoh: K021"
                >
            </div>

            <div class="form-group">
                <label for="tipe_kamar">Tipe Kamar</label>
                <select id="tipe_kamar" name="tipe_kamar">
                    <option value="">Pilih tipe kamar</option>
                    <option value="Standard" {{ old('tipe_kamar') == 'Standard' ? 'selected' : '' }}>Standard</option>
                    <option value="Deluxe" {{ old('tipe_kamar') == 'Deluxe' ? 'selected' : '' }}>Deluxe</option>
                </select>
            </div>

            <div class="form-group">
                <label for="harga">Harga Kamar</label>
                <input
                    type="number"
                    id="harga"
                    name="harga"
                    value="{{ old('harga') }}"
                    placeholder="Masukkan harga kamar"
                    min="0"
                >
                <span class="form-hint">Masukkan harga dalam rupiah tanpa tanda titik.</span>
            </div>

            <div class="form-group">
                <label for="fasilitas">Fasilitas</label>
                <textarea
                    id="fasilitas"
                    name="fasilitas"
                    placeholder="Contoh: Wi-Fi, kamar mandi dalam, lemari"
                >{{ old('fasilitas') }}</textarea>
            </div>

            <div class="form-group">
                <label for="status">Status Kamar</label>
                <select id="status" name="status">
                    <option value="">Pilih status kamar</option>
                    <option value="Tersedia" {{ old('status') == 'Tersedia' ? 'selected' : '' }}>Tersedia</option>
                    <option value="Terisi" {{ old('status') == 'Terisi' ? 'selected' : '' }}>Terisi</option>
                </select>
            </div>

            <div class="form-actions">
                <a href="{{ route('kamar.index') }}" class="btn-form btn-cancel">
                    Kembali
                </a>

                <button type="submit" class="btn-form btn-submit">
                    Simpan Kamar
                </button>
            </div>

        </form>
    </div>

</body>
</html>