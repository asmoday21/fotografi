@extends('guru.layouts.app')

@section('content')
<!-- AOS CSS -->
<link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet" />

<style>
    .form-card {
        background: #023941ff;
        border-radius: 20px;
        padding: 30px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
    }

    .form-label {
        font-weight: 600;
    }

    .form-control,
    .form-select {
        border-radius: 12px;
        padding: 10px 15px;
    }

    .btn-rounded {
        border-radius: 30px;
        padding-left: 25px;
        padding-right: 25px;
    }

    .btn-primary {
        background: linear-gradient(135deg, #3b82f6, #2563eb);
        border: none;
        transition: 0.3s ease;
    }

    .btn-secondary {
        background: #6c757d;
        border: none;
    }

    .btn-primary:hover,
    .btn-secondary:hover {
        transform: translateY(-2px);
        opacity: 0.92;
    }

    .text-gradient {
        background: linear-gradient(to right, #007cf0, #00dfd8);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .tooltip-inner {
        max-width: 220px;
        padding: .5rem;
    }
</style>

<div class="container py-4" data-aos="fade-up">
    <div class="text-center mb-4" data-aos="fade-down">
        <h2 class="fw-bold text-gradient">➕ Tambah Objek 3D</h2>
        <p class="text-muted">Unggah file objek 3D atau gambar ke koleksi Anda dengan mudah</p>
    </div>

    @if($errors->any())
        <div class="alert alert-danger rounded-3" data-aos="zoom-in">
            <ul class="mb-0 ps-3">
                @foreach($errors->all() as $error)
                    <li>• {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="form-card mx-auto" style="max-width: 720px;" data-aos="fade-up" data-aos-delay="100">
        <form action="{{ route('guru.objek3d.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- Judul --}}
            <div class="mb-3">
                <label for="judul" class="form-label">📝 Judul</label>
                <input type="text" name="judul" id="judul"
                       class="form-control @error('judul') is-invalid @enderror"
                       value="{{ old('judul') }}" required>
                @error('judul')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Deskripsi --}}
            <div class="mb-3">
                <label for="deskripsi" class="form-label">🧾 Deskripsi</label>
                <textarea name="deskripsi" id="deskripsi" rows="4"
                          class="form-control @error('deskripsi') is-invalid @enderror"
                          placeholder="Deskripsikan objek ini secara singkat...">{{ old('deskripsi') }}</textarea>
                @error('deskripsi')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- File Upload --}}
            <div class="mb-3">
                <label for="file" class="form-label" data-bs-toggle="tooltip" data-bs-placement="right" title="File .glb, .gltf, .obj, atau gambar .jpg, .png">
                    📁 File Objek 3D / Gambar <small>(.glb, .gltf, .obj, .jpg, .jpeg, .png)</small>
                </label>
                <input type="file" name="file" id="file"
                       class="form-control @error('file') is-invalid @enderror"
                       accept=".glb,.gltf,.obj,.jpg,.jpeg,.png" required>
                @error('file')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Tombol --}}
            <div class="d-flex justify-content-between mt-4">
                <a href="{{ route('guru.objek3d.index') }}" class="btn btn-secondary btn-rounded">
                    <i class="bi bi-arrow-left-circle"></i> Kembali
                </a>
                <button type="submit" class="btn btn-primary btn-rounded">
                    <i class="bi bi-save2-fill"></i> Simpan
                </button>
            </div>
        </form>
    </div>
</div>

<!-- AOS & Bootstrap Tooltip Script -->
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
<script>
    AOS.init();

    // Tooltip Bootstrap 5
    document.addEventListener('DOMContentLoaded', function () {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    });
</script>
@endsection
