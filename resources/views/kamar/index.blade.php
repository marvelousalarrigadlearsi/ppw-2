<!DOCTYPE html>
<html>
<head>
    <title>Data Kamar Kos</title>
</head>
<body>

    <h1>Data Kamar Kos</h1>

    @foreach ($kamars as $kamar)
        <div>
            <h2>Kamar {{ $kamar->nomor_kamar }}</h2>
            <p>Tipe: {{ $kamar->tipe_kamar }}</p>
            <p>Harga: Rp{{ number_format($kamar->harga, 0, ',', '.') }}</p>
            <p>Fasilitas: {{ $kamar->fasilitas }}</p>
            <p>Status: {{ $kamar->status }}</p>
        </div>
        <hr>
    @endforeach

</body>
</html>