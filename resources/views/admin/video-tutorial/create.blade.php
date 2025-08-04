@extends('admin.layouts.admin')

@section('content')
<div class="container my-5">
    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-header bg-primary text-white rounded-top-4">
            <h4 class="mb-0 fw-bold">📹 Tambah Video Tutorial</h4>
        </div>

        <div class="card-body bg-light">
            <form action="{{ route('admin.video-tutorial.store') }}" method="POST" class="needs-validation" novalidate>
                @csrf

                <div class="mb-4">
                    <label class="form-label fw-semibold">🎯 Judul Video</label>
                    <input type="text" name="judul" class="form-control rounded-3" placeholder="Masukkan judul video..." required>
                    <div class="invalid-feedback">Judul tidak boleh kosong.</div>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-semibold">📝 Deskripsi</label>
                    <textarea name="deskripsi" class="form-control rounded-3" rows="4" placeholder="Tulis deskripsi singkat..."></textarea>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-semibold">🔗 URL Video (YouTube Embed)</label>
                  <input type="url" name="url" class="form-control" required placeholder="https://www.youtube.com/watch?v=xxxxxx">
<small class="form-text text-muted">Masukkan URL video YouTube, sistem akan mengubahnya otomatis ke format embed.</small>

                    <div class="form-text">Gunakan URL embed dari YouTube, misal: <code>https://www.youtube.com/embed/abc123</code></div>
                    <div class="invalid-feedback">URL video wajib diisi.</div>
                </div>

                <div class="d-flex justify-content-end">
                    <button class="btn btn-success px-4 py-2 fw-semibold rounded-3 shadow-sm">
                        💾 Simpan Video
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

.card {
    transition: all 0.3s ease;
}
.card:hover {
    transform: translateY(-3px);
    box-shadow: 0 0.75rem 1.5rem rgba(0,0,0,0.1);
}

</style>
@endsection
