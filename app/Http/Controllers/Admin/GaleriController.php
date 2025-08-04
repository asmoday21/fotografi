<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Galeri;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class GaleriController extends Controller
{
    /**
     * Tampilkan semua karya siswa.
     */
    public function index()
    {
        $galeri = Galeri::with('user')->latest()->get();
        return view('admin.galeri.index', compact('galeri'));
    }

    /**
     * Form tambah karya.
     */
    public function create()
    {
        $users = User::whereHas("roles", fn($q) => $q->where("name", "Siswa"))->get();
        return view('admin.galeri.create', compact('users'));
    }

    /**
     * Simpan karya siswa baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'file' => 'required|file|mimes:jpg,jpeg,png,mp4,pdf,glb|max:20480'
        ]);

        $path = $request->file('file')->store('galeri', 'public');

        Galeri::create([
            'user_id' => $request->user_id,
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'file' => $path,
        ]);

        return redirect()->route('admin.galeri.index')->with('success', 'Karya siswa berhasil ditambahkan.');
    }

    /**
     * Form edit karya.
     */
    public function edit($id)
    {
        $galeri = Galeri::findOrFail($id);
        $users = User::whereHas("roles", fn($q) => $q->where("name", "Siswa"))->get();
        return view('admin.galeri.create', compact('galeri', 'users'));
    }

    /**
     * Update karya siswa.
     */
    public function update(Request $request, $id)
    {
        $galeri = Galeri::findOrFail($id);

        $request->validate([
            'user_id' => 'required|exists:users,id',
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'file' => 'nullable|file|mimes:jpg,jpeg,png,mp4,pdf,glb|max:20480'
        ]);

        $data = $request->only('user_id', 'judul', 'deskripsi');

        if ($request->hasFile('file')) {
            // Hapus file lama
            if ($galeri->file && Storage::disk('public')->exists($galeri->file)) {
                Storage::disk('public')->delete($galeri->file);
            }

            // Upload file baru
            $data['file'] = $request->file('file')->store('galeri', 'public');
        }

        $galeri->update($data);

        return redirect()->route('admin.galeri.index')->with('success', 'Karya siswa berhasil diperbarui.');
    }

    /**
     * Hapus karya siswa.
     */
    public function destroy($id)
    {
        $galeri = Galeri::findOrFail($id);

        // Hapus file dari storage
        if ($galeri->file && Storage::disk('public')->exists($galeri->file)) {
            Storage::disk('public')->delete($galeri->file);
        }

        $galeri->delete();

        return redirect()->route('admin.galeri.index')->with('success', 'Karya siswa berhasil dihapus.');
    }
}
