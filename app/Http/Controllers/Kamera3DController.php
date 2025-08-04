<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kamera3D;

class Kamera3DController extends Controller
{
    public function index()
    {
        $items = Kamera3D::latest()->get();
        return view('guru.kamera3d.index', compact('items'));
    }

    public function create()
    {
        return view('kamera3d.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
            'file' => 'required|mimes:glb,gltf|max:71680', // max 70MB (70x1024 KB)
        ]);

        $file = $request->file('file')->store('public/3d');

        Kamera3D::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'file_path' => str_replace('public/', '', $file),
        ]);

        return redirect()->route('kamera3d.index')->with('success', 'Objek berhasil diunggah!');
    }

    public function show($id)
    {
        $item = Kamera3D::findOrFail($id);
        return view('kamera3d.show', compact('item'));
    }
}

