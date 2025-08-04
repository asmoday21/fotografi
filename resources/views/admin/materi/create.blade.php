@extends('guru.layouts.app')

@section('title', 'Tambah Materi Pembelajaran')

@section('content')
<style>
    .materi-bg {
        background-image: url('https://images.unsplash.com/photo-1522199710521-72d69614c702?auto=format&fit=crop&w=1470&q=80');
        background-size: cover;
        background-position: center;
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 40px 20px;
    }

    .form-wrapper {
        background: rgba(255, 255, 255, 0.95);
        padding: 40px;
        border-radius: 20px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        width: 100%;
        max-width: 720px;
    }

    @media (max-width: 768px) {
        .form-wrapper {
            padding: 25px;
        }
    }

    .form-label {
        font-weight: 600;
    }

    .btn-lg {
        border-radius: 30px;
        padding: 10px 24px;
        font-size: 1rem;
    }
</style>

<div class="materi-bg">
    <div class="form-wrapper">
        <h4 class="mb-4 text-center fw-bold text-primary">
            <i class="bi bi-journal-plus me-2"></i> Tambah Materi Pembelajaran
        </h4>

        {{-- Pastikan route-nya sesuai dengan MateriController --}}
        <form action="{{ route('admin.materi.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- Judul --}}
            <div class="mb-3">
                <label for="judul" class="form-label">Judul Materi</label>
                <input type="text" name="judul" id="judul"
                       class="form-control form-control-lg @error('judul') is-invalid @enderror"
                       value="{{ old('judul') }}" required>
                @error('judul')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Deskripsi --}}
            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi</label>
                <textarea name="deskripsi" id="deskripsi" rows="5"
                          class="form-control form-control-lg @error('deskripsi') is-invalid @enderror"
                          required>{{ old('deskripsi') }}</textarea>
                @error('deskripsi')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Upload File --}}
            <div class="mb-3">
                <label for="file" class="form-label">Upload File (PDF / DOC / DOCX / ZIP)</label>
                <input type="file" name="file" id="file"
                       class="form-control form-control-lg @error('file') is-invalid @enderror"
                       accept=".pdf,.doc,.docx,.zip">
                @error('file')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Tombol --}}
            <div class="d-flex justify-content-between mt-4">
                <a href="{{ route('admin.materi.index') }}" class="btn btn-outline-secondary btn-lg">
                    <i class="bi bi-arrow-left-circle me-1"></i> Kembali
                </a>
                <button type="submit" class="btn btn-primary btn-lg">
                    <i class="bi bi-save2 me-1"></i> Simpan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
