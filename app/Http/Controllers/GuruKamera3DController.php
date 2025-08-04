<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kamera3D;
use Illuminate\Support\Facades\Auth;

class GuruKamera3DController extends Controller
{
    public function index()
    {
        $kamera3d = Kamera3D::where('user_id', Auth::id())->get();
        return view('guru.kamera3d.index', compact('kamera3d'));
    }

    public function create()
    {
        return view('guru.kamera3d.create');
    }

public function store(Request $request)
{
    $request->validate([
        'nama' => 'required|string|max:255',
        'deskripsi' => 'required|string',
        'file' => 'required|mimes:glb,gltf|max:71680', // 70MB dalam KB
    ], [
        'file.max' => 'Ukuran file terlalu besar. Maksimum 70MB.',
        'file.mimes' => 'Format file tidak didukung. Hanya .glb atau .gltf.',
    ]);

    $filePath = public_path('uploads/kamera3d/' . $request->file);

    if (!file_exists($filePath)) {
        return back()->with('error', 'File tidak ditemukan di folder uploads/kamera3d.');
    }

    if (filesize($filePath) > 70 * 1024 * 1024) {
        return back()->with('error', 'Ukuran file terlalu besar. Maksimal 70MB.');
    }

    Kamera3D::create([
        'nama' => $request->nama,
        'deskripsi' => $request->deskripsi,
        'file' => $request->file,
    ]);

    return redirect()->route('kamera3d.index')->with('success', 'Data berhasil disimpan.');
}


    public function edit(Kamera3D $kamera3d)
    {
        return view('guru.kamera3d.edit', compact('kamera3d'));
    }

    public function update(Request $request, Kamera3D $kamera3d)
    {
        $request->validate([
            'judul' => 'required',
            'deskripsi' => 'nullable',
            'file' => 'nullable|mimes:gltf,glb|max:10240'
        ]);

        $data = $request->only(['judul', 'deskripsi']);

        if ($request->hasFile('file')) {
            $filename = time() . '.' . $request->file('file')->getClientOriginalExtension();
            $request->file('file')->move(public_path('kamera3d'), $filename);
            $data['file'] = $filename;
        }

        $kamera3d->update($data);

        return redirect()->route('guru.kamera3d.index')->with('success', 'Objek 3D berhasil diperbarui.');
    }

    public function destroy(Kamera3D $kamera3d)
    {
        $kamera3d->delete();
        return redirect()->route('guru.kamera3d.index')->with('success', 'Objek 3D berhasil dihapus.');
    }
}

