@extends('guru.layouts.app')

@section('content')
<div class="container mt-4">
    <h3 class="mb-4">🎥 Tambah Video Tutorial</h3>

    <form action="{{ route('guru.video-tutorial.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="judul" class="form-label fw-semibold">📌 Judul</label>
            <input type="text" class="form-control @error('judul') is-invalid @enderror" id="judul" name="judul" value="{{ old('judul') }}" required>
            @error('judul')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="deskripsi" class="form-label fw-semibold">📝 Deskripsi</label>
            <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" rows="3" required>{{ old('deskripsi') }}</textarea>
            @error('deskripsi')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="video" class="form-label fw-semibold">🎬 Upload Video (MP4)</label>
            <input type="file" class="form-control @error('video') is-invalid @enderror" id="video" name="video" accept="video/mp4">
            <small class="text-muted">Atau kosongkan jika ingin menggunakan link YouTube di bawah</small>
            @error('video')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="url" class="form-label fw-semibold">🌐 Link Video YouTube (opsional)</label>
            <input type="url" class="form-control @error('url') is-invalid @enderror" id="url" name="url" value="{{ old('url') }}" placeholder="https://youtube.com/watch?v=...">
            @error('url')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-success">💾 Simpan</button>
            <a href="{{ route('guru.video-tutorial.index') }}" class="btn btn-secondary">↩️ Batal</a>
        </div>
    </form>
</div>
@endsection
