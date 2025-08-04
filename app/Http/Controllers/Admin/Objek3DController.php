<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Objek3d;
use Illuminate\Support\Facades\Storage;

class Objek3DController extends Controller
{
    public function index()
    {
        $objek3d = Objek3d::latest()->get();
        return view('admin.objek3d.index', compact('objek3d'));
    }

    public function create()
    {
        return view('admin.objek3d.create');
    }

    public function store(Request $request)
    {
        $request->validate([
    'judul' => 'required|string|max:255',
    'deskripsi' => 'nullable|string',
    'file' => 'required|file|mimetypes:application/octet-stream,model/gltf+json,model/gltf-binary,text/plain'
]);


        $file = $request->file('file');
        $ext = strtolower($file->getClientOriginalExtension());

        $filename = uniqid() . '.' . $ext; // pastikan nama file akhir pakai ekstensi asli
        $path = $file->storeAs('objek3d', $filename, 'public');

        Objek3d::create([
            'user_id' => auth()->id(),
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'file' => $path,
        ]);

        return redirect()->route('admin.objek3d.index')->with('success', 'Objek 3D berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $objek3d = Objek3D::findOrFail($id);
        return view('admin.objek3d.edit', compact('objek3d'));
    }

    public function update(Request $request, $id)
    {
        $objek3d = Objek3D::findOrFail($id);

        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'file' => 'nullable|file|mimes:glb,gltf,obj'
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $ext = strtolower($file->getClientOriginalExtension());
            $filename = uniqid() . '.' . $ext;

            // Hapus file lama jika ada
            if ($objek3d->file && Storage::disk('public')->exists($objek3d->file)) {
                Storage::disk('public')->delete($objek3d->file);
            }

            $path = $file->storeAs('objek3d', $filename, 'public');
            $objek3d->file = $path;
        }

        $objek3d->judul = $request->judul;
        $objek3d->deskripsi = $request->deskripsi;
        $objek3d->save();

        return redirect()->route('admin.objek3d.index')->with('success', 'Objek 3D berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $objek = Objek3D::findOrFail($id);

        if ($objek->file && Storage::disk('public')->exists($objek->file)) {
            Storage::disk('public')->delete($objek->file);
        }

        $objek->delete();

        return redirect()->route('admin.objek3d.index')->with('success', 'Objek 3D berhasil dihapus.');
    }

    public function show($id)
    {
        $objek3d = Objek3d::findOrFail($id);
        return view('admin.objek3d.show', compact('objek3d'));
    }
}
