<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminGaleriController extends Controller
{
    public function index()
    {
        $galeri = Galeri::with('user')->latest()->get();
        return view('admin.galeri.index', compact('galeri'));
    }

    public function create()
    {
        $users = User::role('Siswa')->get();
        return view('admin.galeri.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'judul' => 'required',
            'deskripsi' => 'required',
            'file' => 'required|file|mimes:jpg,jpeg,png,mp4,pdf|max:5120',
        ]);

        $path = $request->file('file')->store('galeri', 'public');

        Galeri::create([
            'user_id' => $request->user_id,
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'file' => $path
        ]);

        return redirect()->route('admin.galeri.index')->with('success', 'Karya berhasil ditambahkan');
    }

    public function edit(Galeri $galeri)
    {
        $users = User::role('Siswa')->get();
        return view('admin.galeri.edit', compact('galeri', 'users'));
    }

    public function update(Request $request, Galeri $galeri)
    {
        $request->validate([
            'user_id' => 'required',
            'judul' => 'required',
            'deskripsi' => 'required',
            'file' => 'nullable|file|mimes:jpg,jpeg,png,mp4,pdf|max:5120',
        ]);

        if ($request->hasFile('file')) {
            Storage::disk('public')->delete($galeri->file);
            $path = $request->file('file')->store('galeri', 'public');
            $galeri->file = $path;
        }

        $galeri->update([
            'user_id' => $request->user_id,
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('admin.galeri.index')->with('success', 'Karya berhasil diperbarui');
    }

    public function destroy(Galeri $galeri)
    {
        Storage::disk('public')->delete($galeri->file);
        $galeri->delete();
        return redirect()->route('admin.galeri.index')->with('success', 'Karya berhasil dihapus');
    }
}

