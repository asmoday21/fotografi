<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Galeri;
use App\Models\User;

class GaleriController extends Controller
{
    // ✅ Menampilkan semua karya siswa (dengan filter user_id)
    public function index(Request $request)
    {
        $query = Galeri::with('user');

        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        $galeri = $query->latest()->get();
        $users = User::where('role', 'siswa')->orderBy('name')->get();

        return view('guru.galeri.index', compact('galeri', 'users'));
    }

    // ✅ Form tambah karya
    public function create()
    {
        $users = User::where('role', 'siswa')->orderBy('name')->get();
        return view('guru.galeri.create', compact('users'));
    }

    // ✅ Simpan karya baru
    public function store(Request $request)
    {
        $request->validate([
            'user_id'   => 'required|exists:users,id',
            'judul'     => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'file'      => 'required|file|mimes:jpg,jpeg,png,gif,mp4,mov,avi,pdf,glb|max:20480',
        ]);

        $filePath = $request->file('file')->store('galeri', 'public');

        Galeri::create([
            'user_id'   => $request->user_id,
            'judul'     => $request->judul,
            'deskripsi' => $request->deskripsi,
            'file'      => $filePath,
        ]);

        return redirect()->route('guru.galeri.index')->with('success', 'Karya berhasil diupload!');
    }

    // ✅ Form edit karya
    public function edit($id)
    {
        $galeri = Galeri::findOrFail($id);
        $users = User::where('role', 'siswa')->orderBy('name')->get();
        return view('guru.galeri.edit', compact('galeri', 'users'));
    }

    // ✅ Update karya
    public function update(Request $request, $id)
    {
        $galeri = Galeri::findOrFail($id);

        $request->validate([
            'user_id'   => 'required|exists:users,id',
            'judul'     => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'file'      => 'nullable|file|mimes:jpg,jpeg,png,gif,mp4,mov,avi,pdf,glb|max:20480',
        ]);

        $galeri->user_id   = $request->user_id;
        $galeri->judul     = $request->judul;
        $galeri->deskripsi = $request->deskripsi;

        // Jika file baru diupload, hapus file lama & simpan baru
        if ($request->hasFile('file')) {
            if ($galeri->file && Storage::disk('public')->exists($galeri->file)) {
                Storage::disk('public')->delete($galeri->file);
            }

            $galeri->file = $request->file('file')->store('galeri', 'public');
        }

        $galeri->save();

        return redirect()->route('guru.galeri.index')->with('success', 'Karya berhasil diperbarui.');
    }

    // ✅ Hapus karya
    public function destroy($id)
    {
        $galeri = Galeri::findOrFail($id);

        if (Storage::disk('public')->exists($galeri->file)) {
            Storage::disk('public')->delete($galeri->file);
        }

        $galeri->delete();

        return redirect()->route('guru.galeri.index')->with('success', 'Karya berhasil dihapus.');
    }
}
