<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kamera3D;

class Kamera3DController extends Controller
{
  public function index()
{
    $kamera3ds = Kamera3D::all(); // atau nama model yang kamu pakai
    return view('guru.kamera3d.index', compact('kamera3ds'));
}


    public function create()
    {
        return view('guru.objek3d.create');
    }

public function store(Request $request)
{
    $request->validate([
        'nama' => 'required',
        'deskripsi' => 'required',
        'file_model' => 'required|mimes:glb,gltf|max:70000',
    ]);

    $fileName = $request->file('file_model')->store('3d', 'public');

    $kamera = Kamera3D::create([
        'nama' => $request->nama,
        'deskripsi' => $request->deskripsi,
        'file_model' => $fileName,
    ]);

       return redirect()->route('guru.kamera3d.index')->with('success', 'Berhasil ditambahkan.');

    }

    public function show(Kamera3D $kamera3d)
    {
        return view('guru.objek3d.show', ['kamera' => $kamera3d]);
    }

    public function edit(Kamera3D $kamera3d)
    {
        return view('guru.objek3d.edit', ['kamera' => $kamera3d]);
    }

    public function update(Request $request, Kamera3D $kamera3d)
    {
        $request->validate([
            'nama' => 'required',
            'deskripsi' => 'required',
        ]);

        $data = $request->only(['nama', 'deskripsi']);

        if ($request->hasFile('file_model')) {
            $request->validate([
                'file_model' => 'mimes:glb,gltf|max:70000',
            ]);
            $data['file_model'] = $request->file('file_model')->store('3d', 'public');
        }

        $kamera3d->update($data);
       return redirect()->route('guru.kamera3d.index')->with('success', 'Berhasil diperbarui.');

    }

    public function destroy(Kamera3D $kamera3d)
    {
        $kamera3d->delete();
       return redirect()->route('guru.kamera3d.index')->with('success', 'Berhasil dihapus.');

    }
}
