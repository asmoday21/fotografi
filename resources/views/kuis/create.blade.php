@extends('guru.layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4 text-center">Tambah Soal Kuis 📝</h2>

    <div class="card shadow">
        <div class="card-body">
            <form action="{{ route('kuis.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="pertanyaan" class="form-label">Pertanyaan</label>
                    <textarea class="form-control @error('pertanyaan') is-invalid @enderror" id="pertanyaan" name="pertanyaan" rows="3" required>{{ old('pertanyaan') }}</textarea>
                    @error('pertanyaan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                @foreach(['a', 'b', 'c', 'd'] as $opt)
                <div class="mb-3">
                    <label for="opsi_{{ $opt }}" class="form-label">Opsi {{ strtoupper($opt) }}</label>
                    <input type="text" class="form-control @error('opsi_'.$opt) is-invalid @enderror" id="opsi_{{ $opt }}" name="opsi_{{ $opt }}" value="{{ old('opsi_'.$opt) }}" required>
                    @error('opsi_'.$opt)
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                @endforeach

                <div class="mb-3">
                    <label for="jawaban_benar" class="form-label">Jawaban Benar</label>
                    <select class="form-select @error('jawaban_benar') is-invalid @enderror" id="jawaban_benar" name="jawaban_benar" required>
                        <option value="">-- Pilih Jawaban Benar --</option>
                        <option value="opsi_a" {{ old('jawaban_benar') == 'opsi_a' ? 'selected' : '' }}>Opsi A</option>
                        <option value="opsi_b" {{ old('jawaban_benar') == 'opsi_b' ? 'selected' : '' }}>Opsi B</option>
                        <option value="opsi_c" {{ old('jawaban_benar') == 'opsi_c' ? 'selected' : '' }}>Opsi C</option>
                        <option value="opsi_d" {{ old('jawaban_benar') == 'opsi_d' ? 'selected' : '' }}>Opsi D</option>
                    </select>
                    @error('jawaban_benar')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('kuis.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-check-circle"></i> Simpan Soal
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
