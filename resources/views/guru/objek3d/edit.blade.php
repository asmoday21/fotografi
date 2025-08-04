@extends('guru.layouts.app')

@section('content')
<style>
    .form-card {
        background: #ffffff;
        border-radius: 20px;
        padding: 30px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
    }

    .form-label {
        font-weight: 500;
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

    .btn-success {
        background: linear-gradient(135deg, #16c79a, #12a17d);
        border: none;
    }

    .btn-secondary {
        background: #6c757d;
        border: none;
    }

    .btn-success:hover,
    .btn-secondary:hover {
        opacity: 0.9;
    }
</style>

<div class="container py-4">
    <div class="text-center mb-4">
        <h2 class="fw-bold">✏️ Edit Objek 3D</h2>
        <p class="text-muted">Perbarui informasi dan file objek 3D kamu</p>
    </div>

    @if($errors->any())
        <div class="alert alert-danger rounded-3">
            <ul class="mb-0 ps-3">
                @foreach($errors->all() as $error)
                    <li>• {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="form-card mx-auto" style="max-width: 700px;">
        <form action="{{ route('guru.objek3d.update', $objek3d->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- Judul --}}
            <div class="mb-3">
                <label for="judul" class="form-label">📝 Judul</label>
                <input type="text" name="judul" id="judul"
                    class="form-control @error('judul') is-invalid @enderror"
                    value="{{ old('judul', $objek3d->judul) }}" required>
                @error('judul')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Deskripsi --}}
            <div class="mb-3">
                <label for="deskripsi" class="form-label">🧾 Deskripsi</label>
                <textarea name="deskripsi" id="deskripsi" rows="4"
                    class="form-control @error('deskripsi') is-invalid @enderror"
                    placeholder="Tuliskan deskripsi singkat tentang objek ini...">{{ old('deskripsi', $objek3d->deskripsi) }}</textarea>
                @error('deskripsi')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- File Upload --}}
            <div class="mb-3">
                <label for="file" class="form-label">📂 Ganti File Objek 3D / Gambar <small>(.glb, .gltf, .obj, .jpg, .jpeg, .png)</small></label>
                <input type="file" name="file" id="file"
                    class="form-control @error('file') is-invalid @enderror"
                    accept=".glb,.gltf,.obj,.jpg,.jpeg,.png">
                @error('file')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror

                @if($objek3d->file)
                    <small class="text-muted d-block mt-2">📁 File saat ini: <strong>{{ basename($objek3d->file) }}</strong></small>
                @endif
            </div>

            {{-- Tombol --}}
            <div class="d-flex justify-content-between mt-4">
                <a href="{{ route('guru.objek3d.index') }}" class="btn btn-secondary btn-rounded">⬅️ Kembali</a>
                <button type="submit" class="btn btn-success btn-rounded">💾 Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>
@endsection
