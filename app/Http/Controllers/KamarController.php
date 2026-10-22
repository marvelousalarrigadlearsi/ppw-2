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
        $query->where(
            'nomor_kamar',
            'like',
            '%' . $request->search . '%'
        );
    }

    // Pagination 5 kamar per halaman
    $kamars = $query->latest()->paginate(5)->withQueryString();

    // Statistik seluruh kamar
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
    $validated = $request->validate([
        'nomor_kamar' => 'required|unique:kamars,nomor_kamar',
        'tipe_kamar' => 'required',
        'harga' => 'required|numeric|min:0',
        'fasilitas' => 'required',
        'status' => 'required',
    ], [
        'nomor_kamar.required' => 'Nomor kamar wajib diisi.',
        'nomor_kamar.unique' => 'Nomor kamar sudah digunakan.',
        'tipe_kamar.required' => 'Tipe kamar wajib dipilih.',
        'harga.required' => 'Harga kamar wajib diisi.',
        'harga.numeric' => 'Harga kamar harus berupa angka.',
        'harga.min' => 'Harga kamar tidak boleh negatif.',
        'fasilitas.required' => 'Fasilitas kamar wajib diisi.',
        'status.required' => 'Status kamar wajib dipilih.',
    ]);

    Kamar::create($validated);

    return redirect()->route('kamar.index');
}
    public function update(Request $request, Kamar $kamar)
{
    $validated = $request->validate([
        'nomor_kamar' => 'required|unique:kamars,nomor_kamar,' . $kamar->id,
        'tipe_kamar' => 'required',
        'harga' => 'required|numeric|min:0',
        'fasilitas' => 'required',
        'status' => 'required',
    ], [
        'nomor_kamar.required' => 'Nomor kamar wajib diisi.',
        'nomor_kamar.unique' => 'Nomor kamar sudah digunakan.',
        'tipe_kamar.required' => 'Tipe kamar wajib dipilih.',
        'harga.required' => 'Harga kamar wajib diisi.',
        'harga.numeric' => 'Harga kamar harus berupa angka.',
        'harga.min' => 'Harga kamar tidak boleh negatif.',
        'fasilitas.required' => 'Fasilitas kamar wajib diisi.',
        'status.required' => 'Status kamar wajib dipilih.',
    ]);

    $kamar->update($validated);

    return redirect()->route('kamar.index');
}
public function destroy(Kamar $kamar)
{
    $kamar->delete();

    return redirect()->route('kamar.index')
        ->with('success', 'Kamar berhasil dihapus.');
}
}