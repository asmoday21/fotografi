@extends('admin.layouts.admin')

@section('title', 'Tambah Soal Kuis')

@section('content')
<div class="kuis-bg py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card border-0 shadow-lg rounded-4 bg-white bg-opacity-75 backdrop-blur">
                    <div class="card-header bg-primary text-white rounded-top-4">
                        <h5 class="mb-0"><i class="bi bi-patch-plus-fill me-2"></i> Tambah Soal Kuis</h5>
                    </div>

                    <div class="card-body p-4">
                        <form method="POST" action="{{ route('admin.kuis.store') }}">
                            @csrf

                            <div class="mb-4">
                                <label for="pertanyaan" class="form-label fw-semibold text-secondary">Pertanyaan</label>
                                <textarea name="pertanyaan" id="pertanyaan" class="form-control form-control-lg" rows="3" required></textarea>
                            </div>

                            @foreach(['a', 'b', 'c', 'd'] as $opt)
                            <div class="mb-4">
                                <label for="opsi_{{ $opt }}" class="form-label fw-semibold text-secondary">Opsi {{ strtoupper($opt) }}</label>
                                <input type="text" name="opsi_{{ $opt }}" id="opsi_{{ $opt }}" class="form-control form-control-lg" required>
                            </div>
                            @endforeach

                            <div class="mb-4">
                                <label for="jawaban_benar" class="form-label fw-semibold text-secondary">Jawaban Benar</label>
                                <select name="jawaban_benar" id="jawaban_benar" class="form-select form-select-lg" required>
                                    @foreach(['a', 'b', 'c', 'd'] as $opt)
                                        <option value="{{ $opt }}">{{ strtoupper($opt) }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('admin.kuis.index') }}" class="btn btn-outline-secondary btn-lg rounded-pill">
                                    <i class="bi bi-arrow-left-circle"></i> Batal
                                </a>
                                <button type="submit" class="btn btn-success btn-lg rounded-pill px-4">
                                    <i class="bi bi-save2-fill me-1"></i> Simpan Soal
                                </button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

{{-- STYLE --}}
<style>
.kuis-bg {
    background: linear-gradient(rgba(0,0,0,0.7), rgba(30,30,30,0.7)),
        url('https://images.unsplash.com/photo-1508780709619-79562169bc64?auto=format&fit=crop&w=1470&q=80') center/cover no-repeat fixed;
    min-height: 100vh;
}

.backdrop-blur {
    backdrop-filter: blur(6px);
}

.form-control-lg:focus, .form-select-lg:focus {
    box-shadow: 0 0 0 0.25rem rgba(13,110,253,0.25);
    border-color: #0d6efd;
}
</style>
@endsection
