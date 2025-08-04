@extends('guru.layouts.app')

@section('content')
@push('scripts')
<script type="module" src="https://unpkg.com/@google/model-viewer/dist/model-viewer.min.js"></script>
@endpush

<style>
    .card-3d {
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 6px 16px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        background: #fff;
    }

    .card-3d:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 28px rgba(0, 0, 0, 0.15);
    }

    .card-title {
        font-weight: 600;
        margin-top: 10px;
    }

    model-viewer {
        width: 100%;
        height: 220px;
        background: radial-gradient(circle at center, #ffffff, #e9ecef);
        border-bottom: 1px solid #dee2e6;
    }

    .btn-action {
        border-radius: 30px;
        font-size: 0.85rem;
        margin-right: 5px;
    }
</style>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold">🧊 Daftar Objek 3D</h4>
        <a href="{{ route('guru.objek3d.create') }}" class="btn btn-primary rounded-pill">➕ Tambah Objek 3D</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success rounded-pill px-4 py-2 shadow-sm">
            {{ session('success') }}
        </div>
    @endif

    @if($objek3d->count() > 0)
        <div class="row g-4">
            @foreach($objek3d as $item)
                @php
                    $viewerSrc = asset('storage/' . $item->file);
                @endphp
                <div class="col-md-4 col-lg-3">
                    <div class="card card-3d h-100 d-flex flex-column justify-content-between">
                        <model-viewer
                            src="{{ $viewerSrc }}"
                            alt="{{ $item->judul }}"
                            auto-rotate
                            camera-controls
                            shadow-intensity="1"
                            ar
                            ios-src="{{ $viewerSrc }}">
                        </model-viewer>

                        <div class="p-3 d-flex flex-column justify-content-between flex-grow-1">
                            <h6 class="card-title text-center">{{ $item->judul }}</h6>

                            <div class="d-flex justify-content-center mt-2 flex-wrap">
                                <a href="{{ route('guru.objek3d.show', $item->id) }}" class="btn btn-sm btn-info btn-action">👁️ Lihat</a>
                                <a href="{{ route('guru.objek3d.edit', $item->id) }}" class="btn btn-sm btn-warning btn-action">✏️ Edit</a>
                                <form action="{{ route('guru.objek3d.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger btn-action">🗑️ Hapus</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="alert alert-secondary text-center mt-5">
            📭 Belum ada data objek 3D yang ditambahkan.
        </div>
    @endif
</div>
@endsection
