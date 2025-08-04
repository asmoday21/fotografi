@extends('guru.layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">➕ Tambah Objek 3D Interaktif</h2>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('guru.objek3d.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="judul" class="form-label">Judul</label>
                    <input type="text" class="form-control @error('judul') is-invalid @enderror" id="judul" name="judul" value="{{ old('judul') }}" required>
                    @error('judul')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi</label>
                    <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" rows="3">{{ old('deskripsi') }}</textarea>
                    @error('deskripsi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="file" class="form-label">Upload File Objek 3D (glb, obj, fbx, zip)</label>
                    <input type="file" class="form-control @error('file') is-invalid @enderror" id="file" name="file" required>
                    @error('file')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-success">💾 Simpan</button>
                    <a href="{{ route('guru.objek3d.index') }}" class="btn btn-secondary">↩️ Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
