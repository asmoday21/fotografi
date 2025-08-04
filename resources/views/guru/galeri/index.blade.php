@extends('guru.layouts.app')

@php use Illuminate\Support\Str; @endphp

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
        <h4 class="fw-bold text-primary"><i class="bi bi-image-fill me-2"></i> Galeri Karya Siswa</h4>
        <a href="{{ route('guru.galeri.create') }}" class="btn btn-gradient rounded-pill px-4">
            <i class="bi bi-plus-circle me-2"></i> Tambah Karya
        </a>
    </div>

    {{-- Filter --}}
    <form method="GET" class="mb-4">
        <div class="row g-2">
            <div class="col-md-4">
                <select name="user_id" class="form-select rounded-pill">
                    <option value="">🔍 Filter berdasarkan Siswa</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ request('user_id') == $user->id ? 'selected' : '' }}>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-auto">
                <button class="btn btn-outline-primary rounded-pill px-3" type="submit">
                    <i class="bi bi-funnel me-1"></i> Tampilkan
                </button>
            </div>
        </div>
    </form>

    {{-- Notifikasi --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Grid Galeri --}}
    <div class="row g-4">
        @forelse($galeri as $g)
        @php
            $ext = strtolower(pathinfo($g->file, PATHINFO_EXTENSION));
            $isUrl = Str::startsWith($g->file, ['http://', 'https://']);
            $exists = !$isUrl && Storage::disk('public')->exists($g->file);
            $fileUrl = $isUrl ? $g->file : asset('storage/' . $g->file);
        @endphp

        <div class="col-md-4">
            <div class="card galeri-card shadow-sm h-100 border-0">
                @if($isUrl || $exists)
                    @switch($ext)
                        @case('jpg') @case('jpeg') @case('png')
                            <img src="{{ $fileUrl }}" class="card-img-top" style="height: 220px; object-fit: cover;" alt="{{ $g->judul }}">
                            @break
                        @case('mp4')
                            <video controls class="card-img-top" style="height: 220px; object-fit: cover;">
                                <source src="{{ $fileUrl }}" type="video/mp4">
                            </video>
                            @break
                        @case('pdf')
                            <embed src="{{ $fileUrl }}" type="application/pdf" width="100%" height="220px" />
                            @break
                        @default
                            <iframe src="{{ $fileUrl }}" class="w-100 rounded" style="height: 220px; border: none;"></iframe>
                    @endswitch
                @else
                    <div class="p-3 text-danger">⚠️ File tidak ditemukan di storage.</div>
                @endif

                <div class="card-body d-flex flex-column justify-content-between">
                    <div>
                        <h5 class="card-title text-primary fw-semibold">{{ $g->judul }}</h5>
                        <p class="text-muted small">{{ Str::limit($g->deskripsi, 60) }}</p>
                        <p class="text-secondary small mb-3"><i class="bi bi-person-fill me-1"></i>{{ $g->user->name }}</p>
                    </div>
                    <div class="d-flex justify-content-between mt-auto">
                        <button class="btn btn-sm btn-outline-info rounded-pill" onclick="showFileModal('{{ $fileUrl }}', '{{ $ext }}')">
                            <i class="bi bi-eye"></i> Lihat File Penuh
                        </button>
                        <div class="d-flex gap-1">
                            <a href="{{ route('guru.galeri.edit', $g->id) }}" class="btn btn-sm btn-outline-warning rounded-pill">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('guru.galeri.destroy', $g->id) }}" method="POST" onsubmit="return confirm('Hapus karya ini?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger rounded-pill">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center text-muted">📭 Belum ada karya ditemukan.</div>
        @endforelse
    </div>
</div>

{{-- Modal Preview --}}
<div class="modal fade" id="filePreviewModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content bg-dark text-white border-0">
            <div class="modal-body text-center p-0">
                <div id="previewContainer" class="w-100"></div>
            </div>
            <div class="modal-footer justify-content-center bg-dark">
                <button type="button" class="btn btn-light rounded-pill" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

{{-- Style --}}
<style>
.btn-gradient {
    background: linear-gradient(135deg, #6f42c1, #d63384);
    color: #fff;
    transition: 0.3s ease-in-out;
}
.btn-gradient:hover {
    transform: translateY(-2px);
    opacity: 0.95;
}
.galeri-card {
    border-radius: 20px;
    overflow: hidden;
    transition: transform 0.3s ease;
}
.galeri-card:hover {
    transform: scale(1.02);
}
.card-img-top {
    object-fit: cover;
}
</style>

{{-- Script --}}
<script>
function showFileModal(src, ext) {
    const container = document.getElementById('previewContainer');
    const modal = new bootstrap.Modal(document.getElementById('filePreviewModal'));
    let html = '';

    if (['jpg', 'jpeg', 'png', 'gif', 'webp'].includes(ext)) {
        html = `<img src="${src}" class="img-fluid rounded w-100" style="max-height: 90vh; object-fit: contain;">`;
    } else if (ext === 'mp4') {
        html = `<video src="${src}" controls class="w-100" style="max-height: 90vh;"></video>`;
    } else if (ext === 'pdf') {
        html = `<embed src="${src}" type="application/pdf" class="w-100" style="height: 90vh;" />`;
    } else {
        html = `<iframe src="${src}" class="w-100" style="height: 90vh; border: none;"></iframe>`;
    }

    container.innerHTML = html;
    modal.show();
}
</script>
@endsection
