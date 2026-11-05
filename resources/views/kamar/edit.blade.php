
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Kamar</title>
</head>
<body>

    <h1>Edit Kamar</h1>

    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('kamar.update', $kamar->id) }}"
          method="POST"
          enctype="multipart/form-data">

        @csrf
        @method('PUT')

        <label for="nomor_kamar">Nomor Kamar</label>
        <input
            type="text"
            id="nomor_kamar"
            name="nomor_kamar"
            value="{{ old('nomor_kamar', $kamar->nomor_kamar) }}"
        >

        <label for="tipe_kamar">Tipe Kamar</label>
        <select id="tipe_kamar" name="tipe_kamar">
            <option value="Standard" {{ old('tipe_kamar', $kamar->tipe_kamar) == 'Standard' ? 'selected' : '' }}>
                Standard
            </option>
            <option value="Deluxe" {{ old('tipe_kamar', $kamar->tipe_kamar) == 'Deluxe' ? 'selected' : '' }}>
                Deluxe
            </option>
        </select>

        <label for="harga">Harga</label>
        <input
            type="number"
            id="harga"
            name="harga"
            value="{{ old('harga', $kamar->harga) }}"
        >

        <label for="fasilitas">Fasilitas</label>
        <input
            type="text"
            id="fasilitas"
            name="fasilitas"
            value="{{ old('fasilitas', $kamar->fasilitas) }}"
        >

        <label>Foto Kamar Saat Ini</label>

        @if ($kamar->foto)
            <div>
                <img
                    src="{{ asset('storage/' . $kamar->foto) }}"
                    alt="Foto Kamar"
                    width="200"
                >
            </div>
        @else
            <p>Belum ada foto kamar.</p>
        @endif

        <label for="foto">Ganti Foto Kamar</label>
        <input
            type="file"
            id="foto"
            name="foto"
            accept="image/jpeg,image/png,image/webp"
        >
        <small>Format JPG, PNG, atau WEBP. Maksimal 2 MB.</small>

        <label for="status">Status</label>
        <select id="status" name="status">
            <option value="Tersedia" {{ old('status', $kamar->status) == 'Tersedia' ? 'selected' : '' }}>
                Tersedia
            </option>
            <option value="Terisi" {{ old('status', $kamar->status) == 'Terisi' ? 'selected' : '' }}>
                Terisi
            </option>
        </select>

        <button type="submit">Simpan Perubahan</button>

    </form>

</body>
<link rel="stylesheet" href="{{ asset('css/kamar.css') }}">
</html>
