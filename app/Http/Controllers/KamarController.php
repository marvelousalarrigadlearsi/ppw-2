<?php

namespace App\Http\Controllers;

use App\Models\Kamar;
use Illuminate\Http\Request;

class KamarController extends Controller
{
    public function index(Request $request)
    {
        $query = Kamar::query();

        // Filter berdasarkan tipe kamar
        if ($request->filled('tipe_kamar')) {
            $query->where('tipe_kamar', $request->tipe_kamar);
        }

        // Pencarian berdasarkan nomor kamar
        if ($request->filled('search')) {
            $query->where('nomor_kamar', 'like', '%' . $request->search . '%');
        }

        // 5 kamar terbaru
        $kamars = $query->latest()->take(5)->get();

        // Statistik kamar
        $totalKamar = Kamar::count();
        $totalHarga = Kamar::sum('harga');
        $hargaTertinggi = Kamar::max('harga');
        $hargaTerendah = Kamar::min('harga');

        return view('kamar.index', compact(
            'kamars',
            'totalKamar',
            'totalHarga',
            'hargaTertinggi',
            'hargaTerendah'
        ));
    }
    public function create()
    {
        return view('kamar.create');
    }
    public function edit($id)
{
    $kamar = Kamar::findOrFail($id);

    return view('kamar.edit', compact('kamar'));
}

    public function store(Request $request)
    {
        $request->validate([
            'nomor_kamar' => 'required|unique:kamar,nomor_kamar',
            'tipe_kamar' => 'required',
            'harga' => 'required|numeric',
            'fasilitas' => 'required',
            'status' => 'required',
        ]);

        Kamar::create($request->all());

        return redirect()->route('kamar.index')
            ->with('success', 'Kamar berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
{
    $kamar = Kamar::findOrFail($id);

    $request->validate([
        'nomor_kamar' => 'required|unique:kamars,nomor_kamar,' . $kamar->id,
        'tipe_kamar' => 'required',
        'harga' => 'required|numeric',
        'fasilitas' => 'required',
        'status' => 'required',
    ]);

    $kamar->update($request->all());

    return redirect()->route('kamar.index')
        ->with('success', 'Kamar berhasil diperbarui.');
}
public function destroy($id)
{
    $kamar = Kamar::findOrFail($id);

    $kamar->delete();

    return redirect()->route('kamar.index')
        ->with('success', 'Kamar berhasil dihapus.');
}
}