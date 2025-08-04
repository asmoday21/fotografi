@extends('siswa.layouts.app')

@section('title', '🎮 Galeri Objek 3D')

@section('head')
  <!-- Model Viewer -->
  <script type="module" src="https://unpkg.com/@google/model-viewer/dist/model-viewer.min.js"></script>
  <style>
    model-viewer {
      width: 100%;
      height: 230px;
      background: #1e293b;
      border-radius: 10px 10px 0 0;
    }

    .card-3d {
      border-radius: 12px;
      overflow: hidden;
      background: #f8fafc;
      border: none;
      box-shadow: 0 8px 24px rgba(0,0,0,0.1);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      opacity: 0;
      transform: translateY(30px);
    }

    .card-3d.in-view {
      opacity: 1;
      transform: translateY(0);
    }

    .card-3d:hover {
      transform: translateY(-5px);
      box-shadow: 0 16px 32px rgba(0,0,0,0.15);
    }

    .btn-outline-dark:hover {
      background-color: #0ea5e9;
      color: #fff;
      border-color: #0ea5e9;
    }

    .modal-content {
      border-radius: 0;
    }

    .fade-up {
      opacity: 0;
      transform: translateY(30px);
      transition: all 0.6s ease;
    }

    .fade-up.show {
      opacity: 1;
      transform: translateY(0);
    }
  </style>
@endsection

@section('content')
  <h4 class="mb-4 fw-bold text-primary fade-up">🌐 Galeri Objek 3D Interaktif</h4>

  @if(session('success'))
    <div class="alert alert-success rounded-pill px-4 py-2 text-center fade-up show">
      ✅ {{ session('success') }}
    </div>
  @endif

  @if($objek3d->count() > 0)
    <div class="row g-4">
      @foreach($objek3d as $item)
        <div class="col-md-6 col-lg-4">
          <div class="card card-3d h-100 d-flex flex-column">
            <model-viewer
              src="{{ asset('storage/' . $item->file) }}"
              alt="{{ $item->judul }}"
              auto-rotate
              camera-controls
              ar
              ios-src="{{ asset('storage/' . $item->file) }}"
              loading="lazy">
            </model-viewer>

            <div class="p-3 d-flex flex-column flex-grow-1 justify-content-between">
              <h5 class="card-title text-dark text-center mb-2">{{ $item->judul }}</h5>
              <div class="mb-3">
                <h6 class="fw-semibold text-info">📄 Deskripsi</h6>
                <p class="text-muted small">{{ $item->deskripsi ?? 'Tidak ada deskripsi.' }}</p>
              </div>
              <div class="text-center mt-2">
                <button class="btn btn-outline-dark btn-sm rounded-pill" data-bs-toggle="modal" data-bs-target="#fullscreenModal{{ $item->id }}">
                  <i class="bi bi-arrows-fullscreen me-1"></i> Lihat Fullscreen
                </button>
              </div>
              <p class="text-center mt-3 text-muted small">📅 {{ $item->created_at->format('d M Y') }}</p>
            </div>
          </div>
        </div>

        <!-- Modal Fullscreen -->
        <div class="modal fade" id="fullscreenModal{{ $item->id }}" tabindex="-1" aria-labelledby="fullscreenModalLabel{{ $item->id }}" aria-hidden="true">
          <div class="modal-dialog modal-fullscreen">
            <div class="modal-content bg-dark text-white">
              <div class="modal-header border-0">
                <h5 class="modal-title" id="fullscreenModalLabel{{ $item->id }}">{{ $item->judul }}</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body p-0">
                <model-viewer
                  src="{{ asset('storage/' . $item->file) }}"
                  alt="{{ $item->judul }}"
                  auto-rotate
                  camera-controls
                  ar
                  ios-src="{{ asset('storage/' . $item->file) }}"
                  style="width: 100%; height: 100vh;">
                </model-viewer>

                <div class="p-4 bg-dark border-top border-secondary">
                  <h6 class="fw-semibold text-info">📄 Deskripsi </h6>
                  <p class="mb-0">{{ $item->deskripsi ?? 'Tidak ada deskripsi.' }}</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  @else
    <div class="alert alert-warning text-center mt-5 py-4 shadow-sm fade-up show">
      📭 Belum ada data objek 3D yang ditambahkan.
    </div>
  @endif
@endsection

@section('scripts')
<script>
  // Animasi ketika elemen masuk viewport
  const cards = document.querySelectorAll('.card-3d');
  const fadeItems = document.querySelectorAll('.fade-up');

  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('in-view');
        entry.target.classList.add('show');
      }
    });
  }, {
    threshold: 0.1
  });

  cards.forEach(card => observer.observe(card));
  fadeItems.forEach(item => observer.observe(item));
</script>
@endsection
