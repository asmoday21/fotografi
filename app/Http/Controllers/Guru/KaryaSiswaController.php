<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KaryaSiswa;
use Illuminate\Support\Facades\Auth;

class KaryaSiswaController extends Controller
{
    public function index()
    {
        $karya = KaryaSiswa::orderBy('created_at', 'desc')->get();
        return view('guru.karyasiswa.index', compact('karya'));
    }

    public function create()
    {
        return view('guru.karyasiswa.create');
    }

    public function store(Request $request)
{
    $request->validate([
        'judul' => 'required|string|max:255',
        'deskripsi' => 'nullable|string',
        'file' => 'required|file|mimes:jpg,jpeg,png,pdf',
    ]);

    if ($request->hasFile('file')) {
        // Simpan file ke folder "galeri" di storage/app/public/galeri
        $path = $request->file('file')->store('galeri', 'public');

        // Simpan ke database
        KaryaSiswa::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'file' => 'storage/' . $path, // simpan path yang bisa diakses publik
            'user_id' => auth()->id(), // atau sesuai dengan implementasimu
        ]);
    }

    return redirect()->route('guru.karyasiswa.index')->with('success', 'Karya berhasil diunggah!');
}


    public function destroy(KaryaSiswa $karyasiswa)
    {
        $karyasiswa->delete();
        return back()->with('success', 'Karya berhasil dihapus.');
    }
}

