@extends('admin.layouts.admin')

@section('content')
<div class="container my-5">
    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-header bg-warning text-dark rounded-top-4">
            <h4 class="fw-bold mb-0">✏️ Edit Video Tutorial</h4>
        </div>

        <div class="card-body bg-light">
            @if ($errors->any())
                <div class="alert alert-danger rounded-3 shadow-sm">
                    <strong>⚠️ Oops!</strong> Ada kesalahan pada input Anda:
                    <ul class="mb-0 mt-2">
                        @foreach ($errors->all() as $error)
                            <li class="small">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.video-tutorial.update', $videoTutorial->id) }}" method="POST" class="needs-validation" novalidate>
    @csrf
    @method('PUT')

    <div class="mb-4">
        <label for="judul" class="form-label fw-semibold">🎯 Judul Video</label>
        <input type="text" name="judul" id="judul" class="form-control rounded-3" value="{{ old('judul', $videoTutorial->judul) }}" required>
        <div class="invalid-feedback">Judul tidak boleh kosong.</div>
    </div>

    <div class="mb-4">
        <label for="deskripsi" class="form-label fw-semibold">📝 Deskripsi</label>
        <textarea name="deskripsi" id="deskripsi" class="form-control rounded-3" rows="4">{{ old('deskripsi', $videoTutorial->deskripsi) }}</textarea>
    </div>

    <div class="mb-4">
        <label for="url" class="form-label fw-semibold">🔗 URL Video (YouTube Embed)</label>
        <input type="url" name="url" id="url" class="form-control rounded-3" value="{{ old('url', $videoTutorial->url) }}" required>
        <div class="form-text">Gunakan URL embed dari YouTube, misal: <code>https://www.youtube.com/embed/abc123</code></div>
        <div class="invalid-feedback">URL wajib diisi dan harus valid.</div>
    </div>

    <div class="d-flex justify-content-between">
        <a href="{{ route('admin.video-tutorial.index') }}" class="btn btn-secondary px-4 rounded-3 fw-semibold shadow-sm">
            🔙 Batal
        </a>
        <button type="submit" class="btn btn-primary px-4 fw-semibold rounded-3 shadow-sm">
            💾 Simpan Perubahan
        </button>
    </div>
</form>

        </div>
    </div>
</div>
<style>
    input:focus,
textarea:focus {
    border-color: #6366f1;
    box-shadow: 0 0 0 0.2rem rgba(99, 102, 241, 0.2);
}

.card:hover {
    transform: translateY(-3px);
    transition: all 0.3s ease;
    box-shadow: 0 0.75rem 1.5rem rgba(0,0,0,0.1);
}

</style>
@endsection
