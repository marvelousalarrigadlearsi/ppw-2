<form action="{{ route('kamar.store') }}" method="POST">
    @csrf

    <label>Nomor Kamar</label>
    <input type="text" name="nomor_kamar">

    <label>Tipe Kamar</label>
    <select name="tipe_kamar">
        <option value="Standard">Standard</option>
        <option value="Deluxe">Deluxe</option>
    </select>

    <label>Harga</label>
    <input type="number" name="harga">

    <label>Fasilitas</label>
    <input type="text" name="fasilitas">

    <label>Status</label>
    <select name="status">
        <option value="Tersedia">Tersedia</option>
        <option value="Terisi">Terisi</option>
    </select>

    <button type="submit">Simpan</button>
</form>