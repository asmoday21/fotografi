<?php

// app/Http/Controllers/AdminKuisController.php
namespace App\Http\Controllers;

use App\Models\Kuis;
use Illuminate\Http\Request;

class AdminKuisController extends Controller
{
    public function index()
    {
        $kuis = Kuis::latest()->get();
        return view('admin.kuis.index', compact('kuis'));
    }

    public function create()
    {
        return view('admin.kuis.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'pertanyaan' => 'required',
            'opsi_a' => 'required',
            'opsi_b' => 'required',
            'opsi_c' => 'required',
            'opsi_d' => 'required',
            'jawaban_benar' => 'required|in:a,b,c,d',
        ]);

        Kuis::create($request->all());

        return redirect()->route('admin.kuis.index')->with('success', 'Soal kuis berhasil ditambahkan.');
    }

    public function edit(Kuis $kui)
    {
        return view('admin.kuis.edit', ['kui' => $kui]);
    }

    public function update(Request $request, Kuis $kui)
    {
        $request->validate([
            'pertanyaan' => 'required',
            'opsi_a' => 'required',
            'opsi_b' => 'required',
            'opsi_c' => 'required',
            'opsi_d' => 'required',
            'jawaban_benar' => 'required|in:a,b,c,d',
        ]);

        $kui->update($request->all());

        return redirect()->route('admin.kuis.index')->with('success', 'Soal kuis berhasil diperbarui.');
    }

    public function destroy(Kuis $kui)
    {
        $kui->delete();
        return redirect()->route('admin.kuis.index')->with('success', 'Soal kuis berhasil dihapus.');
    }
}
