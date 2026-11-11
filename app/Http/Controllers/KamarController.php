<?php

namespace App\Http\Controllers;

use App\Models\Kamar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class KamarController extends Controller
{
    public function index(Request $request)
    {
        $query = Kamar::query();

        
        if ($request->filled('tipe_kamar')) {
            $query->where('tipe_kamar', $request->tipe_kamar);
        }

        
        if ($request->filled('search')) {
            $query->where(
                'nomor_kamar',
                'like',
                '%' . $request->search . '%'
            );
        }

        
        $kamars = $query->latest()->paginate(5)->withQueryString();

       
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
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ], [
            'nomor_kamar.required' => 'Nomor kamar wajib diisi.',
            'nomor_kamar.unique' => 'Nomor kamar sudah digunakan.',
            'tipe_kamar.required' => 'Tipe kamar wajib dipilih.',
            'harga.required' => 'Harga kamar wajib diisi.',
            'harga.numeric' => 'Harga kamar harus berupa angka.',
            'harga.min' => 'Harga kamar tidak boleh negatif.',
            'fasilitas.required' => 'Fasilitas kamar wajib diisi.',
            'status.required' => 'Status kamar wajib dipilih.',
            'foto.image' => 'File harus berupa gambar.',
            'foto.mimes' => 'Format foto harus JPG, JPEG, PNG, atau WEBP.',
            'foto.max' => 'Ukuran foto maksimal 2 MB.',
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $this->simpanFoto($request->file('foto'));
        }

        Kamar::create($validated);

        return redirect()->route('kamar.index');
    }

    public function update(Request $request, $id)
    {
        $kamar = Kamar::findOrFail($id);

        $validated = $request->validate([
            'nomor_kamar' => [
                'required',
                Rule::unique('kamars', 'nomor_kamar')->ignore($kamar->id),
            ],
            'tipe_kamar' => 'required',
            'harga' => 'required|numeric|min:0',
            'fasilitas' => 'required',
            'status' => 'required',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ], [
            'nomor_kamar.required' => 'Nomor kamar wajib diisi.',
            'nomor_kamar.unique' => 'Nomor kamar sudah digunakan.',
            'tipe_kamar.required' => 'Tipe kamar wajib dipilih.',
            'harga.required' => 'Harga kamar wajib diisi.',
            'harga.numeric' => 'Harga kamar harus berupa angka.',
            'harga.min' => 'Harga kamar tidak boleh negatif.',
            'fasilitas.required' => 'Fasilitas kamar wajib diisi.',
            'status.required' => 'Status kamar wajib dipilih.',
            'foto.image' => 'File harus berupa gambar.',
            'foto.mimes' => 'Format foto harus JPG, JPEG, PNG, atau WEBP.',
            'foto.max' => 'Ukuran foto maksimal 2 MB.',
        ]);

        if ($request->hasFile('foto')) {
            // Hapus foto lama beserta thumbnail-nya
            $this->hapusFoto($kamar->foto);

            $validated['foto'] = $this->simpanFoto($request->file('foto'));
        }

        $kamar->update($validated);

        return redirect()->route('kamar.index');
    }

    public function destroy(Kamar $kamar)
    {
        
        $this->hapusFoto($kamar->foto);

        $kamar->delete();

        return redirect()->route('kamar.index')
            ->with('success', 'Kamar berhasil dihapus.');
    }

   
private function simpanFoto($file): string
{
    
    $path = $file->store('foto-kamar', 'public');

    
    $manager = new ImageManager(new Driver());
    $thumbnail = $manager->read($file->getRealPath())->cover(300, 300);

    
    $ekstensi = strtolower($file->getClientOriginalExtension());

    $hasil = match ($ekstensi) {
        'png'  => $thumbnail->toPng(),
        'webp' => $thumbnail->toWebp(80),
        default => $thumbnail->toJpeg(80),
    };

    Storage::disk('public')->put(
        'foto-kamar/thumbnails/' . basename($path),
        (string) $hasil
    );

    return $path;

    }

    
    private function hapusFoto(?string $path): void
    {
        if (! $path) {
            return;
        }

        Storage::disk('public')->delete([
            $path,
            'foto-kamar/thumbnails/' . basename($path),
        ]);
    }
}