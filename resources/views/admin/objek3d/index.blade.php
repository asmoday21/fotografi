@extends('admin.layouts.admin')

@section('content')
<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold text-gradient">🎨 Galeri Objek 3D Siswa</h4>
        <a href="{{ route('admin.objek3d.create') }}" class="btn btn-gradient shadow-sm rounded-pill px-4">
            + Tambah Objek
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show rounded-3 shadow-sm" role="alert">
            ✅ {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if($objek3d->isEmpty())
        <div class="text-center text-muted py-5">
            📭 Belum ada data objek 3D.
        </div>
    @else
        <div class="row g-4">
            @foreach($objek3d as $item)
            <div class="col-md-4 col-sm-6">
                <div class="card objek3d-card shadow-lg border-0 rounded-4 h-100 fade-in">
                    <div class="model-preview p-2">
                        <model-viewer
                            src="{{ asset('storage/' . $item->file) }}"
                            alt="Model 3D"
                            auto-rotate
                            camera-controls
                            shadow-intensity="1"
                            exposure="1.2"
                            style="width: 100%; height: 250px; background: #f7f7f7; border-radius: 16px;">
                        </model-viewer>
                    </div>
                    <div class="card-body d-flex flex-column justify-content-between">
                        <div>
                            <h5 class="card-title fw-bold text-dark text-center">{{ $item->judul }}</h5>
                        </div>
                        <div class="d-flex justify-content-between mt-3">
                            <a href="{{ route('admin.objek3d.show', $item->id) }}" class="btn btn-sm btn-outline-info rounded-pill">
                                👁️ Lihat
                            </a>
                            <a href="{{ route('admin.objek3d.edit', $item->id) }}" class="btn btn-sm btn-outline-warning rounded-pill">
                                ✏️ Edit
                            </a>
                            <form action="{{ route('admin.objek3d.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger rounded-pill">🗑️</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @endif
</div>
@endsection

@push('scripts')
<script type="module" src="https://unpkg.com/@google/model-viewer/dist/model-viewer.min.js"></script>
@endpush

<style>
.fade-in {
    animation: fadeInUp 0.6s ease forwards;
    opacity: 0;
}
@keyframes fadeInUp {
    0% { transform: translateY(20px); opacity: 0; }
    100% { transform: translateY(0); opacity: 1; }
}
.objek3d-card {
    background: linear-gradient(to bottom right, #ffffff, #f9f9f9);
    border-radius: 20px;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.objek3d-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.12);
}
.btn-gradient {
    background: linear-gradient(135deg, #6f42c1, #d63384);
    color: #fff;
    font-weight: 600;
    border: none;
}
.btn-gradient:hover {
    background: linear-gradient(135deg, #5c33a6, #c2256c);
}
.text-gradient {
    background: linear-gradient(90deg, #6f42c1, #d63384);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    font-weight: bold;
}
</style>
