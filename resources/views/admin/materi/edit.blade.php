@extends('admin.layouts.admin')

@section('title', 'Edit Materi')

@section('content')
<div class="edit-materi-bg py-5 animate__animated animate__fadeIn">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
                   

                    <div class="card-body p-4 bg-white">
                        <form action="{{ route('admin.materi.update', $materi->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            {{-- Judul --}}
                            <div class="mb-4">
                                <label for="judul" class="form-label fw-semibold text-secondary">Judul Materi <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-lg @error('judul') is-invalid @enderror" id="judul" name="judul" placeholder="Masukkan judul materi" value="{{ old('judul', $materi->judul) }}" required>
                                @error('judul')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Deskripsi --}}
                            <div class="mb-4">
                                <label for="deskripsi" class="form-label fw-semibold text-secondary">Deskripsi <span class="text-danger">*</span></label>
                                <textarea class="form-control form-control-lg @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" rows="5" placeholder="Tuliskan deskripsi materi" required>{{ old('deskripsi', $materi->deskripsi) }}</textarea>
                                @error('deskripsi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Upload File --}}
                            <div class="mb-4">
                                <label for="file" class="form-label fw-semibold text-secondary">Upload File PDF (Opsional)</label>
                                <input type="file" class="form-control form-control-lg @error('file') is-invalid @enderror" id="file" name="file" accept="application/pdf">
                                @error('file')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror

                                @if($materi->file_path)
                                    <small class="text-muted mt-2 d-block">
                                        File saat ini: 
                                        <a href="{{ asset('storage/' . $materi->file_path) }}" target="_blank">
                                            <i class="bi bi-file-earmark-pdf-fill text-danger"></i> Lihat PDF
                                        </a>
                                    </small>
                                @endif
                            </div>

                            {{-- Tombol --}}
                            <div class="d-flex justify-content-end gap-3">
                                <a href="{{ route('admin.materi.index') }}" class="btn btn-outline-secondary btn-lg rounded-pill">
                                    <i class="bi bi-arrow-left-circle"></i> Batal
                                </a>
                                <button type="submit" class="btn btn-success btn-lg rounded-pill px-4 shadow">
                                    <i class="bi bi-save2-fill me-1"></i> Simpan Perubahan
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- STYLE SECTION --}}
<style>
.edit-materi-bg {
     background: linear-gradient(rgba(15, 32, 39, 0.8), rgba(44, 62, 80, 0.8)),
        url('{{ asset('assets/img/edit.jpg') }}') center/cover no-repeat fixed; 
              
    min-height: 100vh;
}

.card {
    backdrop-filter: blur(4px);
}

input:focus, textarea:focus {
    box-shadow: 0 0 0 0.25rem rgba(13,110,253,0.25);
    border-color: #0d6efd;
}

.card-header, label.form-label {
    letter-spacing: 0.5px;
}

.form-control-lg {
    border-radius: 12px;
}
</style>
@endsection
