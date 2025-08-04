<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Objek3d;
use Illuminate\Support\Facades\Storage;

class Objek3DController extends Controller
{
    public function index()
    {
        $objek3d = Objek3d::latest()->get();
        return view('guru.objek3d.index', compact('objek3d'));
    }



    public function create()
    {
        return view('guru.objek3d.create');
    }




  public function store(Request $request)
{
    $request->validate([
        'judul' => 'required|string|max:255',
        'deskripsi' => 'nullable|string',
        // atau pakai ini untuk menghindari error MIME
        // 'file' => 'required|file', // lebih longgar
    ]);

    $file = $request->file('file');
    $ext = strtolower($file->getClientOriginalExtension());
    $allowed = ['glb', 'gltf', 'obj', 'jpg', 'jpeg', 'png'];

    if (!in_array($ext, $allowed)) {
        return back()->withErrors(['file' => 'Format file tidak didukung.']);
    }

    $path = $file->store('objek3d', 'public');

    Objek3d::create([
        'user_id' => auth()->id(),
        'judul' => $request->judul,
        'deskripsi' => $request->deskripsi,
        'file' => $path,
    ]);

    return redirect()->route('guru.objek3d.index')->with('success', 'Objek 3D berhasil ditambahkan.');
}




public function edit($id)
{
    $objek3d = Objek3D::findOrFail($id);
    return view('guru.objek3d.edit', compact('objek3d'));
}



 public function update(Request $request, $id)
{
    $objek3d = Objek3D::findOrFail($id);

    $request->validate([
        'judul' => 'required|string|max:255',
        'deskripsi' => 'nullable|string',
        'file' => 'nullable|file|mimes:glb,gltf,obj,jpg,jpeg,png'
    ]);

    // Jika ada file baru diupload
    if ($request->hasFile('file')) {
        $file = $request->file('file');
        $ext = strtolower($file->getClientOriginalExtension());
        $allowed = ['glb', 'gltf', 'obj', 'jpg', 'jpeg', 'png'];

        if (!in_array($ext, $allowed)) {
            return back()->withErrors(['file' => 'Format file tidak didukung.'])->withInput();
        }

        // Hapus file lama jika ada
        if ($objek3d->file && Storage::disk('public')->exists($objek3d->file)) {
            Storage::disk('public')->delete($objek3d->file);
        }

        // Simpan file baru
        $path = $file->store('objek3d', 'public');
        $objek3d->file = $path;
    }

    // Update data lainnya
    $objek3d->judul = $request->judul;
    $objek3d->deskripsi = $request->deskripsi;
    $objek3d->save();

    return redirect()->route('guru.objek3d.index')->with('success', 'Objek 3D berhasil diperbarui.');
}



public function destroy($id)
{
    $objek = Objek3D::findOrFail($id);
    
    // Hapus file jika ada
    if ($objek->file && \Storage::exists($objek->file)) {
        \Storage::delete($objek->file);
    }

    $objek->delete();

    return redirect()->route('guru.objek3d.index')->with('success', 'Objek 3D berhasil dihapus.');
}

public function show($id)
{
    $objek3d = Objek3d::findOrFail($id);
    return view('guru.objek3d.show', compact('objek3d'));
}


}
