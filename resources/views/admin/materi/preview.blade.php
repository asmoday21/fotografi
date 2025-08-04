@extends('admin.layouts.admin')

@section('title', 'Preview Materi')

@section('content')
<div class="container-fluid py-4">
    <div class="card shadow-sm mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0"><i class="bi bi-file-earmark-pdf-fill me-2"></i> {{ $materi->judul }}</h5>
            <a href="{{ route('admin.materi.index') }}" class="btn btn-sm btn-secondary"><i class="bi bi-arrow-left"></i> Kembali</a>
        </div>
        <div class="card-body">
            <p class="text-muted">{{ $materi->deskripsi }}</p>
            <hr>
            <div style="height: 600px;">
                <iframe src="{{ asset('storage/' . $materi->file_path) }}" width="100%" height="100%" frameborder="0"></iframe>
            </div>
        </div>
    </div>

    {{-- Komentar --}}
    <div class="card shadow-sm">
        <div class="card-header">
            <h6 class="mb-0">💬 Diskusi & Komentar</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('comments.store') }}" method="POST">
                @csrf
                <input type="hidden" name="materi_id" value="{{ $materi->id }}">
                <textarea name="content" class="form-control mb-2" rows="3" placeholder="Tulis komentar..." required></textarea>
                <button class="btn btn-primary btn-sm"><i class="bi bi-chat-left-dots"></i> Kirim</button>
            </form>

            <hr>

            @forelse($materi->comments as $comment)
                <div class="mb-3 border-bottom pb-2">
                    <strong>{{ $comment->user->name }}</strong><br>
                    <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
                    <p>{{ $comment->content }}</p>
                </div>
            @empty
                <p class="text-muted">Belum ada komentar.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection
