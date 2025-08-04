@extends('admin.layouts.admin')

@php use Illuminate\Support\Str; @endphp

@section('content')
<div class="galeri-bg py-5">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
            <a href="{{ route('admin.galeri.create') }}" class="btn-add-karya">
                <span>+ Tambah Karya</span>
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="row g-4">
            @forelse($galeri as $g)
                @php
                    $isUrl = Str::startsWith($g->file, ['http://', 'https://']);
                    $ext = strtolower(pathinfo($g->file, PATHINFO_EXTENSION));
                    $src = $isUrl ? $g->file : asset('storage/' . $g->file);
                    $modalId = 'modalImage' . $g->id;
                @endphp

                <div class="col-md-4">
                    <div class="card galeri-card fade-in h-100">
                        @switch($ext)
                            @case('jpg') @case('jpeg') @case('png')
                                <img src="{{ $src }}" class="card-img-top img-fluid" style="height: 220px; object-fit: cover;" alt="{{ $g->judul }}" />
                                @break

                            @case('mp4')
                                <video controls class="w-100 rounded-top" style="height: 220px; object-fit: cover;">
                                    <source src="{{ $src }}" type="video/mp4">
                                </video>
                                @break

                            @case('pdf')
                                <embed src="{{ $src }}" type="application/pdf" width="100%" height="220px" class="rounded-top" />
                                @break

                            @default
                                <iframe src="{{ $src }}" class="w-100" style="height: 220px; border: none;"></iframe>
                        @endswitch

                        <div class="card-body">
                            <h5 class="card-title text-primary fw-semibold">{{ $g->judul }}</h5>
                            <p class="card-text text-muted small">{{ Str::limit($g->deskripsi, 60) }}</p>
                            <p class="mb-2 text-secondary small">
                                <i class="bi bi-person-circle me-1"></i> {{ $g->user->name }}
                            </p>
                            <a href="{{ route('admin.galeri.edit', $g->id) }}" class="btn btn-sm btn-outline-warning rounded-pill me-2 hover-glow">
                                <i class="bi bi-pencil-fill"></i> Edit
                            </a>
                            <form action="{{ route('admin.galeri.destroy', $g->id) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger rounded-pill hover-glow" onclick="return confirm('Yakin ingin menghapus karya ini?')">
                                    <i class="bi bi-trash3-fill"></i> Hapus
                                </button>
                            </form>

                            <button class="btn btn-sm btn-outline-primary rounded-pill mt-2" onclick="showFileModal('{{ $src }}', '{{ $ext }}')">
                                👁️ Lihat File Penuh
                            </button>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center text-light mt-4">
                    <i class="bi bi-info-circle me-2"></i> Belum ada karya siswa ditambahkan.
                </div>
            @endforelse
        </div>
    </div>
</div>

{{-- Modal Preview File --}}
<div class="modal fade" id="filePreviewModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content bg-dark text-white border-0">
            <div class="modal-body text-center p-0">
                <div id="previewContainer" class="w-100">
                    <!-- Konten akan diisi via JS -->
                </div>
            </div>
            <div class="modal-footer justify-content-center bg-dark">
                <button type="button" class="btn btn-light rounded-pill" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

{{-- CSS --}}
<style>
    .btn-add-karya {
        padding: 12px 24px;
        background: linear-gradient(135deg, #6f42c1, #d63384);
        color: white;
        font-weight: 600;
        border-radius: 50px;
        text-decoration: none;
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
        transition: 0.3s ease;
    }

    .btn-add-karya:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
    }

    .fade-in {
        animation: fadeInUp 0.6s ease forwards;
        opacity: 0;
    }

    @keyframes fadeInUp {
        0% { transform: translateY(20px); opacity: 0; }
        100% { transform: translateY(0); opacity: 1; }
    }

    .galeri-card {
        background: rgba(255, 255, 255, 0.95);
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        transition: 0.3s ease;
    }

    .galeri-card:hover {
        transform: scale(1.02);
        box-shadow: 0 12px 28px rgba(0, 0, 0, 0.2);
    }

    .hover-glow:hover {
        box-shadow: 0 0 10px rgba(0, 123, 255, 0.6);
        transform: scale(1.05);
    }

    .card-title {
        font-size: 1.1rem;
    }

    .card-body {
        padding: 1rem 1.25rem;
    }
</style>

{{-- JS Modal Preview --}}
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
