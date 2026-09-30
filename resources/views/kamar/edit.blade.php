<!DOCTYPE html>
<html>
<head>
    <title>Edit Kamar</title>
</head>
<body>

    <h1>Edit Kamar</h1>

    <form action="{{ route('kamar.update', $kamar->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label>Nomor Kamar</label>
        <input type="text" name="nomor_kamar" value="{{ $kamar->nomor_kamar }}">

        <label>Tipe Kamar</label>
        <select name="tipe_kamar">
            <option value="Standard" {{ $kamar->tipe_kamar == 'Standard' ? 'selected' : '' }}>
                Standard
            </option>
            <option value="Deluxe" {{ $kamar->tipe_kamar == 'Deluxe' ? 'selected' : '' }}>
                Deluxe
            </option>
        </select>

        <label>Harga</label>
        <input type="number" name="harga" value="{{ $kamar->harga }}">

        <label>Fasilitas</label>
        <input type="text" name="fasilitas" value="{{ $kamar->fasilitas }}">

        <label>Status</label>
        <select name="status">
            <option value="Tersedia" {{ $kamar->status == 'Tersedia' ? 'selected' : '' }}>
                Tersedia
            </option>
            <option value="Terisi" {{ $kamar->status == 'Terisi' ? 'selected' : '' }}>
                Terisi
            </option>
        </select>

        <button type="submit">Simpan Perubahan</button>
    </form>

</body>
</html>