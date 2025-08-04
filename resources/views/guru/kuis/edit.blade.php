@extends('guru.layouts.app')

@section('content')
<div class="container mt-4">
    <h4 class="fw-bold mb-4">✏️ Edit Soal Kuis</h4>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Ups!</strong> Ada kesalahan pada input.<br><br>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('guru.kuis.update', $kuis->id) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Pertanyaan</label>
            <textarea name="pertanyaan" class="form-control" rows="3" required>{{ old('pertanyaan', $kuis->pertanyaan) }}</textarea>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label">Opsi A</label>
                <input type="text" name="opsi_a" class="form-control" required value="{{ old('opsi_a', $kuis->opsi_a) }}">
            </div>
            <div class="col-md-6">
                <label class="form-label">Opsi B</label>
                <input type="text" name="opsi_b" class="form-control" required value="{{ old('opsi_b', $kuis->opsi_b) }}">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label">Opsi C</label>
                <input type="text" name="opsi_c" class="form-control" required value="{{ old('opsi_c', $kuis->opsi_c) }}">
            </div>
            <div class="col-md-6">
                <label class="form-label">Opsi D</label>
                <input type="text" name="opsi_d" class="form-control" required value="{{ old('opsi_d', $kuis->opsi_d) }}">
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Jawaban Benar</label>
            <select name="jawaban_benar" class="form-select" required>
                <option value="">-- Pilih Jawaban --</option>
                <option value="A" {{ old('jawaban_benar', $kuis->jawaban_benar) == 'A' ? 'selected' : '' }}>A</option>
                <option value="B" {{ old('jawaban_benar', $kuis->jawaban_benar) == 'B' ? 'selected' : '' }}>B</option>
                <option value="C" {{ old('jawaban_benar', $kuis->jawaban_benar) == 'C' ? 'selected' : '' }}>C</option>
                <option value="D" {{ old('jawaban_benar', $kuis->jawaban_benar) == 'D' ? 'selected' : '' }}>D</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success"><i class="bi bi-save"></i> Simpan Perubahan</button>
        <a href="{{ route('guru.kuis.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
