@extends('layouts.app')

@section('content')
<div class="container py-4">
  <div class="mb-4">
    <h2 class="fw-bold text-primary d-flex align-items-center gap-2">
      📘 {{ $materi->judul }}
    </h2>
    <p class="text-muted">{!! nl2br(e($materi->deskripsi)) !!}</p>
  </div>

  {{-- Tombol Unduh --}}
  @if($materi->file)
    <a href="{{ asset('storage/' . $materi->file) }}" class="btn btn-outline-primary btn-sm rounded-pill mb-4" target="_blank">
      📎 Unduh Materi
    </a>
  @endif

  {{-- Video Kamera/YouTube (opsional) --}}
  @if($materi->url)
    <div class="mb-4">
      <h6 class="fw-bold mb-2">🎥 Video Pendukung</h6>
      <div class="ratio ratio-16x9 rounded shadow-sm">
        <iframe src="{{ $materi->url }}" frameborder="0" allowfullscreen></iframe>
      </div>
    </div>
  @endif

  {{-- Flipbook Viewer --}}
  @if($materi->file_path && Storage::disk('public')->exists($materi->file_path))
    <div id="flipbookContainer" class="mb-5 shadow rounded overflow-hidden">
      <div id="flipbook" style="width: 100%; height: 450px;"></div>
    </div>

    {{-- FlipBook Script --}}
    <script src="https://unpkg.com/pdfjs-dist@3.4.120/build/pdf.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/page-flip/dist/js/page-flip.browser.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/page-flip/dist/css/page-flip.min.css">

    <script>
      const fileUrl = "{{ asset('storage/' . $materi->file_path) }}";

      const flipbook = new St.PageFlip(document.getElementById('flipbook'), {
        width: 60,
        height: 40,
        size: "stretch",
        maxShadowOpacity: 0.5,
        showCover: true,
        mobileScrollSupport: true
      });

      fetch(fileUrl).then(res => res.blob()).then(blob => {
        const url = URL.createObjectURL(blob);
        flipbook.loadFromPDF(url);
      });
    </script>
  @else
    <div class="alert alert-warning">⚠️ File tidak ditemukan atau belum diunggah.</div>
  @endif

  {{-- Komentar --}}
  <div class="mt-5">
    <h5 class="fw-bold mb-3">💬 Komentar</h5>
    <form action="{{ route('comments.store') }}" method="POST" class="mb-4">
      @csrf
      <input type="hidden" name="materi_id" value="{{ $materi->id }}">
      <textarea name="content" class="form-control mb-2" rows="3" required placeholder="Tulis komentar..."></textarea>
      <button class="btn btn-primary btn-sm">💬 Kirim Komentar</button>
    </form>
    <hr>
    @forelse($materi->comments as $comment)
      <div class="mb-3">
        <div class="d-flex justify-content-between">
          <strong>{{ $comment->user->name ?? 'Anonim' }}</strong>
          <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
        </div>
        <p class="mb-1">{{ $comment->content }}</p>
      </div>
    @empty
      <p class="text-muted">Belum ada komentar.</p>
    @endforelse
  </div>

  <div class="mt-4">
    <a href="{{ route('siswa.materi.index') }}" class="btn btn-secondary btn-sm">⬅️ Kembali ke Materi</a>
  </div>
</div>
@endsection
