@extends('guru.layouts.app') {{-- atau siswa.layouts.app --}}

@section('content')
<div class="container mt-4">
    <h4 class="mb-3">🗨️ Diskusi Materi: <span class="text-primary">{{ $materi->judul }}</span></h4>

    {{-- Flash Message --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show">
            {{ $errors->first() }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Deskripsi Materi --}}
    <div class="mb-4 p-3 bg-light border-start border-4 border-primary rounded shadow-sm">
        <strong>Deskripsi:</strong>
        <p class="mb-0">{{ $materi->deskripsi }}</p>
    </div>

    {{-- Form Komentar --}}
    <form action="{{ route('komentar.store') }}" method="POST" class="mb-4">
        @csrf
        <input type="hidden" name="materi_id" value="{{ $materi->id }}">
        <textarea name="content" class="form-control mb-2" rows="3" placeholder="Tulis komentar Anda..." required></textarea>
        <button class="btn btn-primary rounded-pill px-4">
            <i class="bi bi-chat-left-dots"></i> Kirim Komentar
        </button>
    </form>

    {{-- Daftar Komentar --}}
    <h5 class="mb-3">💬 Komentar:</h5>

    @forelse ($materi->comments as $komentar)
        <div class="border p-3 mb-3 rounded bg-white shadow-sm">
            <div class="d-flex justify-content-between">
                <strong>{{ $komentar->user->name ?? 'Pengguna' }}</strong>
                <small class="text-muted">{{ $komentar->created_at->diffForHumans() }}</small>
            </div>
            <p class="mb-2">{{ $komentar->content }}</p>

            {{-- Balasan --}}
            @foreach ($komentar->replies as $balas)
                <div class="ms-4 ps-3 pt-2 pb-1 border-start border-2 border-secondary bg-light rounded mb-2">
                    <div class="d-flex justify-content-between">
                        <strong>{{ $balas->user->name ?? 'Pengguna' }}</strong>
                        <small class="text-muted">{{ $balas->created_at->diffForHumans() }}</small>
                    </div>
                    <p class="mb-1">{{ $balas->content }}</p>
                </div>
            @endforeach

            {{-- Form Balas --}}
            <form action="{{ route('komentar.store') }}" method="POST" class="ms-4 mt-2">
                @csrf
                <input type="hidden" name="materi_id" value="{{ $materi->id }}">
                <input type="hidden" name="parent_id" value="{{ $komentar->id }}">
                <textarea name="content" class="form-control mb-2" rows="2" placeholder="Balas komentar..." required></textarea>
                <button class="btn btn-sm btn-outline-primary">
                    <i class="bi bi-reply-fill"></i> Balas
                </button>
            </form>
        </div>
    @empty
        <p class="text-muted">Belum ada komentar untuk materi ini.</p>
    @endforelse
</div>
@endsection
