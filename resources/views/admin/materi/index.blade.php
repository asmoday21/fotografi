@extends('admin.layouts.admin')

@section('title', 'Kelola Materi Pembelajaran')

@section('content')

<style>
    .materi-container {
        background-color: #ffffff;
        border-radius: 20px;
        padding: 30px;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
    }

    .card-materi {
        border: none;
        border-radius: 16px;
        background: #fdfdfd;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
    }

    .card-materi:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
    }

    .btn-outline-info {
        border-radius: 50px;
    }

    .badge-tanggal {
        font-size: 0.75rem;
        background: #eef2ff;
        color: #4f46e5;
        padding: 4px 10px;
        border-radius: 50px;
        display: inline-block;
        margin-top: 6px;
    }

    .pdf-preview {
        height: 400px;
        border: 1px solid #dcdcdc;
        border-radius: 10px;
        margin-top: 15px;
        box-shadow: 0 0 8px rgba(0,0,0,0.05);
    }

    .komentar-box {
        background: #f7f7f7;
        border-left: 3px solid #0d6efd;
        border-radius: 8px;
        padding: 10px 15px;
        margin-bottom: 10px;
    }

    .form-control {
        border-radius: 10px;
    }

    @media (max-width: 768px) {
        .pdf-preview {
            height: 250px;
        }
    }
</style>

<script>
    function togglePreview(id) {
        const el = document.getElementById(id);
        el.classList.toggle('d-none');
    }
</script>

<div class="container py-4">
    <div class="materi-container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold text-primary">
                <i class="bi bi-journal-text me-2"></i> Daftar Materi Pembelajaran
            </h4>
            <a href="{{ route('admin.materi.create') }}" class="btn btn-primary btn-sm shadow">
                <i class="bi bi-plus-lg"></i> Tambah Materi
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success shadow-sm">{{ session('success') }}</div>
        @endif

        <div class="row g-4">
            @foreach($materi as $item)
                <div class="col-md-6">
                    <div class="card card-materi p-3">
                        <div class="card-body">
                            <h5 class="card-title fw-semibold text-primary">{{ $item->judul }}</h5>
                            <p class="card-text text-muted">{{ \Illuminate\Support\Str::limit($item->deskripsi, 100) }}</p>

                            @if($item->file_path)
                                <button class="btn btn-sm btn-outline-info mt-2" onclick="togglePreview('preview-{{ $item->id }}')">
                                    <i class="bi bi-eye-fill"></i> Preview
                                </button>

                                <div id="preview-{{ $item->id }}" class="d-none">
                                    <iframe src="{{ route('admin.materi.preview', $item->id) }}" class="pdf-preview w-100" frameborder="0"></iframe>

                                    <h6 class="mt-4 mb-2 text-primary">💬 Diskusi & Komentar</h6>
                                    <form action="{{ route('comments.store') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="materi_id" value="{{ $item->id }}">
                                        <textarea name="content" class="form-control mb-2" rows="3" placeholder="Tulis komentar..." required></textarea>
                                        <button class="btn btn-primary btn-sm"><i class="bi bi-chat-left-dots"></i> Kirim</button>
                                    </form>

                                    @foreach($item->comments as $comment)
                                        <div class="komentar-box mt-3">
                                            <strong>{{ $comment->user->name }}</strong><br>
                                            <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
                                            <p class="mb-0">{{ $comment->content }}</p>
                                        </div>
                                    @endforeach
                                </div>
                            @endif

                            <div class="badge-tanggal mt-3">
                                <i class="bi bi-calendar-event"></i> {{ $item->created_at->format('d M Y') }}
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

@endsection
