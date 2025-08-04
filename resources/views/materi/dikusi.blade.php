@extends('layouts.app')
@section('title', 'Diskusi Materi')
@section('content')
<div class="container py-4">
    <div class="card shadow p-4 mb-4">
        <h4 class="text-primary">📘 {{ $materi->judul }}</h4>
        <p class="text-muted">{{ $materi->deskripsi }}</p>

        @if($materi->file_path)
            <iframe src="{{ asset('storage/' . $materi->file_path) }}" class="w-100" height="500px" frameborder="0"></iframe>
        @endif
    </div>

    <div class="card shadow p-4">
        <h5 class="text-primary mb-3">💬 Diskusi & Komentar</h5>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('komentar.store') }}" method="POST" class="mb-4">
            @csrf
            <input type="hidden" name="materi_id" value="{{ $materi->id }}">
            <textarea name="content" rows="3" class="form-control mb-2" placeholder="Tulis komentar..." required></textarea>
            <button class="btn btn-primary btn-sm">Kirim Komentar</button>
        </form>
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

        @foreach($komentar as $komen)
            <div class="border p-3 mb-3 rounded bg-light">
                <strong>{{ $komen->user->name }}</strong> <small class="text-muted">{{ $komen->created_at->diffForHumans() }}</small>
                <p class="mb-1">{{ $komen->content }}</p>

                <form action="{{ route('komentar.store') }}" method="POST" class="ms-3 mb-2">
                    @csrf
                    <input type="hidden" name="materi_id" value="{{ $materi->id }}">
                    <input type="hidden" name="parent_id" value="{{ $komen->id }}">
                    <input type="text" name="content" class="form-control form-control-sm mb-1" placeholder="Balas..." required>
                    <button class="btn btn-sm btn-outline-secondary">Balas</button>
                </form>

                @foreach($komen->replies as $reply)
                    <div class="bg-white p-2 ms-4 border-start mt-2">
                        <strong>{{ $reply->user->name }}</strong> <small class="text-muted">{{ $reply->created_at->diffForHumans() }}</small>
                        <p class="mb-0">{{ $reply->content }}</p>
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>
</div>
@endsection