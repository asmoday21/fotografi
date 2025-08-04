<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Kuis;
use Illuminate\Http\Request;

class KuisController extends Controller
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
            'jawaban_benar' => 'required',
        ]);

        Kuis::create([
            'pertanyaan' => $request->pertanyaan,
            'opsi_a' => $request->opsi_a,
            'opsi_b' => $request->opsi_b,
            'opsi_c' => $request->opsi_c,
            'opsi_d' => $request->opsi_d,
            'jawaban_benar' => $request->jawaban_benar,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('admin.kuis.index')->with('success', 'Kuis berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $kuis = Kuis::findOrFail($id);
        return view('admin.kuis.edit', compact('kuis'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'pertanyaan' => 'required',
            'opsi_a' => 'required',
            'opsi_b' => 'required',
            'opsi_c' => 'required',
            'opsi_d' => 'required',
            'jawaban_benar' => 'required|in:opsi_a,opsi_b,opsi_c,opsi_d',
        ]);

        $kuis = Kuis::findOrFail($id);
        $kuis->update($request->all());

        return redirect()->route('admin.kuis.index')->with('success', 'Kuis berhasil diperbarui.');
    }

    public function destroy($id)
    {
        Kuis::destroy($id);
        return redirect()->route('admin.kuis.index')->with('success', 'Kuis berhasil dihapus.');
    }
    public function destroyByJudul($judul)
{
    \App\Models\Kuis::where('judul', $judul)->delete();
    return redirect()->route('guru.kuis.index')->with('success', 'Semua soal dengan judul "' . $judul . '" telah dihapus.');
}

}
