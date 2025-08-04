@extends('admin.layouts.admin')

@section('title', 'Komentar & Diskusi Materi')

@section('content')
<div class="container py-4">
    <h4 class="fw-bold mb-4">💬 Komentar & Balasan Materi</h4>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @forelse($komentar as $kom)
        <div class="border rounded p-3 mb-3 bg-light shadow-sm">
            <div class="d-flex justify-content-between">
                <div>
                    <strong>{{ $kom->user->name }}</strong> di 
                    <span class="badge bg-secondary">{{ $kom->materi->judul }}</span>
                </div>
                <small class="text-muted">{{ $kom->created_at->diffForHumans() }}</small>
            </div>
            <p class="mb-2">{{ $kom->content }}</p>

            {{-- Balasan --}}
            @foreach($kom->replies as $balas)
                <div class="ps-4 ms-3 border-start border-primary mb-2">
                    <div>
                        <strong>{{ $balas->user->name }}</strong> membalas
                        <small class="text-muted">{{ $balas->created_at->diffForHumans() }}</small>
                    </div>
                    <p class="mb-1">{{ $balas->content }}</p>
                </div>
            @endforeach

            {{-- Form Balas --}}
            <form action="{{ route('admin.komentar.balas', $kom->id) }}" method="POST" class="mt-2">
                @csrf
                <div class="input-group">
                    <input type="text" name="content" class="form-control" placeholder="Balas komentar..." required>
                    <button class="btn btn-primary"><i class="bi bi-reply-fill"></i></button>
                </div>
            </form>
        </div>
    @empty
        <div class="alert alert-info">Belum ada komentar masuk.</div>
    @endforelse
</div>
@endsection
