@extends('guru.layouts.app')

@section('content')
<div class="container mt-4">
    <h3 class="mb-4">✏️ Edit Video Tutorial</h3>

    <form action="{{ route('guru.video-tutorial.update', ['video_tutorial' => $video->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- Judul --}}
        <div class="mb-3">
            <label for="judul" class="form-label fw-semibold">📌 Judul</label>
            <input type="text" class="form-control @error('judul') is-invalid @enderror" id="judul" name="judul"
                value="{{ old('judul', $video->judul) }}" required>
            @error('judul')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Deskripsi --}}
        <div class="mb-3">
            <label for="deskripsi" class="form-label fw-semibold">📝 Deskripsi</label>
            <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi"
                rows="3" required>{{ old('deskripsi', $video->deskripsi) }}</textarea>
            @error('deskripsi')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Upload file video (opsional) --}}
        <div class="mb-3">
            <label for="video" class="form-label fw-semibold">🎬 Upload Ulang Video (MP4) <small class="text-muted">(opsional)</small></label>
            <input type="file" class="form-control @error('video') is-invalid @enderror" id="video" name="video" accept="video/mp4">
            <small class="text-muted">Kosongkan jika tidak ingin mengganti file video lama.</small>
            @error('video')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

   {{-- URL YouTube --}}
<!-- <div class="mb-4">
    <label for="url" class="form-label fw-semibold">🌐 Link Video YouTube (opsional)</label>
    <input type="url" name="url" id="url"
        value="{{ old('url', $video->url) }}"
        class="form-control @error('url') is-invalid @enderror"
        placeholder="https://www.youtube.com/watch?v=xxxxx">
    @error('url')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div> -->


        {{-- Tombol --}}
        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-success">💾 Update</button>
            <a href="{{ route('guru.video-tutorial.index') }}" class="btn btn-secondary">↩️ Batal</a>
        </div>
    </form>
</div>
@endsection
