@extends('admin.layouts.admin')

@section('title', 'Preview Objek 3D')

@section('content')
<div class="container my-5">
    <div class="card objek3d-preview-card shadow-lg border-0 rounded-4 p-3">
        <div class="card-header bg-gradient-primary text-white rounded-3 d-flex justify-content-between align-items-center px-4 py-3">
            <h4 class="mb-0 fw-bold">
                👁️ Preview Objek 3D
            </h4>
            <a href="{{ route('admin.objek3d.index') }}" class="btn btn-light btn-sm fw-semibold rounded-pill">
                ← Kembali ke Galeri
            </a>
        </div>

        <div class="card-body bg-light rounded-4 p-4">
            <h5 class="text-center fw-bold mb-4">{{ $objek3d->judul }}</h5>
            <div class="model-viewer-wrapper mb-4">
                <model-viewer
                    src="{{ asset('storage/' . $objek3d->file) }}"
                    alt="{{ $objek3d->judul }}"
                    auto-rotate
                    camera-controls
                    shadow-intensity="1"
                    exposure="1.1"
                    ar
                    style="width: 100%; height: 500px; border-radius: 16px; background: #f3f3f3;">
                </model-viewer>
            </div>

            {{-- Optional: Tambahkan deskripsi jika diperlukan --}}
            {{-- 
            <p class="text-muted text-center">
                {{ $objek3d->deskripsi ?? 'Tidak ada deskripsi tersedia.' }}
            </p> 
            --}}
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script type="module" src="https://unpkg.com/@google/model-viewer/dist/model-viewer.min.js"></script>
@endpush

<style>
/* Efek Card Stylish */
.objek3d-preview-card {
    backdrop-filter: blur(8px);
    background: rgba(255, 255, 255, 0.93);
    animation: fadeSlideUp 0.5s ease;
}

/* Animasi muncul */
@keyframes fadeSlideUp {
    from { opacity: 0; transform: translateY(20px); }
    to   { opacity: 1; transform: translateY(0); }
}

/* Header Gradient */
.bg-gradient-primary {
    background: linear-gradient(135deg, #6f42c1, #d63384);
    color: white;
}

/* Responsive model-viewer */
@media (max-width: 768px) {
    model-viewer {
        height: 350px !important;
    }
}
</style>
