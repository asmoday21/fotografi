<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GaleriController extends Controller
{
    public function index()
    {
        $galeri = Galeri::with('user')->latest()->get();
        return view('galeri.index', compact('galeri'));
    }

    public function create()
    {
        $users = User::role('Siswa')->get();
        return view('galeri.create', compact('users'));
    }

    public function store(Request $request)
{
    $request->validate([
        'user_id' => 'required|exists:users,id',
        'judul' => 'required|string|max:255',
        'deskripsi' => 'required|string',
        'file' => 'required|file|mimes:jpg,jpeg,png,mp4,pdf,glb,bin',
    ]);

    $file = $request->file('file');
    $filename = time() . '_' . $file->getClientOriginalName();
    $file->storeAs('galeri', $filename, 'public');

    Galeri::create([
        'user_id' => $request->user_id,
        'judul' => $request->judul,
        'deskripsi' => $request->deskripsi,
        'file' => $filename, // hanya simpan nama file
    ]);

    return redirect()->route('galeri.index')->with('success', 'Karya berhasil diunggah!');
}

    public function edit(Galeri $galeri)
    {
        $users = User::role('Siswa')->get();
        return view('galeri.edit', compact('galeri', 'users'));
    }

    public function update(Request $request, Galeri $galeri)
{
    $request->validate([
        'user_id' => 'required|exists:users,id',
        'judul' => 'required|string|max:255',
        'deskripsi' => 'required|string',
        'file' => 'nullable|file|mimes:jpg,jpeg,png,mp4,pdf,glb,bin',
    ]);

    if ($request->hasFile('file')) {
        if ($galeri->file && Storage::disk('public')->exists('galeri/' . $galeri->file)) {
            Storage::disk('public')->delete('galeri/' . $galeri->file);
        }

        $filename = time() . '_' . $request->file('file')->getClientOriginalName();
        $request->file('file')->storeAs('galeri', $filename, 'public');
        $galeri->file = $filename;
    }

    $galeri->update([
        'user_id' => $request->user_id,
        'judul' => $request->judul,
        'deskripsi' => $request->deskripsi,
    ]);

    $galeri->save();

    return redirect()->route('galeri.index')->with('success', 'Karya berhasil diperbarui!');
}

    public function destroy($id)
    {
        $galeri = Galeri::findOrFail($id);

        if ($galeri->file && Storage::disk('public')->exists($galeri->file)) {
            Storage::disk('public')->delete($galeri->file);
        }

        $galeri->delete();

        return redirect()->route('admin.galeri.index')->with('success', 'Karya berhasil dihapus.');
    }
}
