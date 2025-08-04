@extends('siswa.layouts.app')

@section('content')
<div class="container py-5">
  <h2 class="fw-bold text-gradient mb-4">
    <i class="fas fa-video me-2"></i>Video Tutorial Pembelajaran
  </h2>

  <div class="row">
    @forelse($videos as $video)
      <div class="col-md-6 col-lg-4 mb-4">
        <div class="card border-0 shadow bg-gradient-dark text-white rounded-4 h-100 overflow-hidden">
          <div class="ratio ratio-16x9">
            @php
              $url = $video->url;
              if(Str::contains($url, 'watch?v=')) {
                $url = str_replace('watch?v=', 'embed/', $url);
              }
            @endphp
            <iframe src="{{ $url }}" title="{{ $video->judul }}" allowfullscreen class="rounded-top"></iframe>
          </div>
          <div class="card-body d-flex flex-column">
            <h5 class="card-title text-info">{{ $video->judul }}</h5>
            @if($video->deskripsi)
              <p class="text-light small">{{ Str::limit($video->deskripsi, 100) }}</p>
            @endif
            <p class="text-end text-secondary small mt-auto">📅 {{ $video->created_at->format('d M Y') }}</p>
          </div>
        </div>
      </div>
    @empty
      <div class="col-12">
        <div class="alert alert-info text-center">📭 Belum ada video tutorial yang tersedia.</div>
      </div>
    @endforelse
  </div>
</div>

<style>
  .text-gradient { background: linear-gradient(90deg, #0dcaf0, #6610f2); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
  .bg-gradient-dark { background: linear-gradient(145deg, #212529, #1a1e21); }
  .card:hover { transform: translateY(-5px); transition: all 0.3s ease; box-shadow: 0 10px 30px rgba(0, 123, 255, 0.3); }
</style>
@endsection
