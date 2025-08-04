@extends('siswa.layouts.app')
@php use Illuminate\Support\Facades\Storage; @endphp


@section('content')

<div class="d-flex justify-content-center gap-3 mb-4">
  <button class="btn btn-primary rounded-pill px-4" onclick="document.getElementById('section-materi').scrollIntoView({ behavior: 'smooth' })">
    📘 Lihat Materi Pembelajaran
  </button>
  <button class="btn btn-danger rounded-pill px-4" onclick="document.getElementById('section-video').scrollIntoView({ behavior: 'smooth' })">
    🎥 Lihat Video Pembelajaran
  </button>
</div>

<div class="container py-5">
 <h2 id="section-materi" class="fw-bold text-gradient mb-4">
  <i class="fas fa-book-open me-2"></i>Materi Pembelajaran
</h2>


  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  {{-- PDF.js CDN --}}
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.4.120/pdf.min.js"></script>

  @php $materiGrouped = $materi->groupBy('sub_bab'); @endphp

  @forelse($materiGrouped as $subBab => $items)
    <h4 class="mb-4 fw-bold text-primary">📚 Sub Bab: {{ $subBab }}</h4>

    @foreach($items as $item)
      @php
        $fileUrl = asset('storage/' . $item->file_path);
        $ext = pathinfo($item->file_path, PATHINFO_EXTENSION);
        $id = $item->id;
      @endphp

      <div class="card mb-5 materi-card shadow-lg p-4">
        <div class="card-body">
          <h5 class="card-title fw-semibold text-dark mb-2">
            <i class="fas fa-file-alt me-2 text-primary"></i>{{ $item->judul }}
          </h5>
          <p class="text-muted mb-3">{{ $item->deskripsi }}</p>

          @if(!empty($item->ringkasan))
            <div class="mb-3">
              <h6 class="text-secondary fw-bold">📄 Ringkasan Materi:</h6>
              <p class="text-muted">{{ $item->ringkasan }}</p>
            </div>
          @endif
          
 {{-- Video dari URL --}}
@if($item->video_url)
  @php
    $embedUrl = str_replace('watch?v=', 'embed/', $item->video_url);
  @endphp
  <div class="mb-2" style="max-width: 640px; margin: auto;">
    <div class="ratio ratio-16x9 rounded shadow">
      <iframe src="{{ $embedUrl }}" frameborder="0" allowfullscreen class="rounded"></iframe>
    </div>
  </div>
@endif

{{-- Video dari file lokal --}}
@if($item->video_path && Storage::disk('public')->exists($item->video_path))
  <div class="mt-2 mb-4" style="max-width: 640px; margin: auto;">
    <video class="w-100 rounded shadow" controls>
      <source src="{{ asset('storage/' . $item->video_path) }}" type="video/mp4">
      Browser Anda tidak mendukung tag video.
    </video>
  </div>
@endif


          @php
            $poinList = is_array($item->poin_penting)
              ? $item->poin_penting
              : (is_string($item->poin_penting) ? explode(';', $item->poin_penting) : []);
          @endphp

          @if(count($poinList))
            <div class="mb-3">
              <h6 class="text-secondary fw-bold">🔍 Poin Penting:</h6>
              <ul class="list-group list-group-flush">
                @foreach($poinList as $poin)
                  <li class="list-group-item bg-light rounded my-1">
                    <i class="fas fa-check-circle text-success me-2"></i>{{ trim($poin) }}
                  </li>
                @endforeach
              </ul>
            </div>
          @endif

          @if($ext === 'pdf' && Storage::disk('public')->exists($item->file_path))
           <div class="pdf-wrapper">
  <button class="btn btn-outline-primary btn-sm mb-3" onclick="document.getElementById('viewer-{{ $id }}').classList.toggle('d-none')">
    📖 Lihat Materi
  </button>

  <div id="viewer-{{ $id }}" class="d-none">
    <canvas id="pdf-canvas-{{ $id }}" class="pdf-canvas shadow mb-2"></canvas>

    <div class="pdf-controls mt-2" id="controls-{{ $id }}">
      <button class="btn btn-outline-primary btn-sm" onclick="prevPage{{ $id }}()">⬅ Sebelumnya</button>
      <button class="btn btn-outline-primary btn-sm" onclick="nextPage{{ $id }}()">Selanjutnya ➡</button>
    </div>

    <p class="text-muted small mt-2">
      Halaman <span id="page-num-{{ $id }}">1</span> dari <span id="page-count-{{ $id }}">?</span>
    </p>
  </div>
</div>


            <script>
              const url_{{ $id }} = "{{ $fileUrl }}";
              let pdfDoc_{{ $id }} = null,
                  pageNum_{{ $id }} = 1,
                  canvas_{{ $id }} = document.getElementById('pdf-canvas-{{ $id }}'),
                  ctx_{{ $id }} = canvas_{{ $id }}.getContext('2d');

              pdfjsLib.getDocument(url_{{ $id }}).promise.then(pdf => {
                pdfDoc_{{ $id }} = pdf;
                document.getElementById('page-count-{{ $id }}').textContent = pdf.numPages;
                renderPage{{ $id }}(pageNum_{{ $id }});
              });

              function renderPage{{ $id }}(num) {
                pdfDoc_{{ $id }}.getPage(num).then(page => {
                  const viewport = page.getViewport({ scale: 1.2 });
                  canvas_{{ $id }}.height = viewport.height;
                  canvas_{{ $id }}.width = viewport.width;

                  page.render({ canvasContext: ctx_{{ $id }}, viewport });

                  document.getElementById('page-num-{{ $id }}').textContent = num;
                });
              }

              function nextPage{{ $id }}() {
                if (pageNum_{{ $id }} < pdfDoc_{{ $id }}.numPages) {
                  pageNum_{{ $id }}++;
                  renderPage{{ $id }}(pageNum_{{ $id }});
                }
              }

              function prevPage{{ $id }}() {
                if (pageNum_{{ $id }} > 1) {
                  pageNum_{{ $id }}--;
                  renderPage{{ $id }}(pageNum_{{ $id }});
                }
              }

              function toggleFullscreen{{ $id }}() {
                const canvas = document.getElementById('pdf-canvas-{{ $id }}');
                const controls = document.getElementById('controls-{{ $id }}');

                if (!document.fullscreenElement) {
                  canvas.requestFullscreen().then(() => {
                    controls.style.position = 'fixed';
                    controls.style.bottom = '20px';
                    controls.style.left = '50%';
                    controls.style.transform = 'translateX(-50%)';
                    controls.style.zIndex = 1000;
                  });
                } else {
                  document.exitFullscreen().then(() => {
                    controls.removeAttribute("style");
                  });
                }
              }
            </script>
          @else
            <div class="text-danger small">❌ File tidak ditemukan atau bukan PDF</div>
          @endif

          <a href="{{ route('siswa.materi.diskusi', $id) }}" class="btn btn-outline-success btn-sm rounded-pill mt-3">
            💬 Diskusi Materi Ini
          </a>
        </div>
      </div>
    @endforeach
  @empty
    <div class="alert alert-warning text-center">📭 Belum ada materi tersedia.</div>
  @endforelse

  {{-- VIDEO SECTION --}}
 <h3 id="section-video" class="fw-bold text-gradient mt-5 mb-4">
  <i class="fas fa-video me-2"></i>Video Tutorial Pembelajaran
</h3>

  <div class="row">
    @forelse($videos as $video)
      <div class="col-md-6 col-lg-4 mb-4">
        <div class="card border-0 shadow bg-gradient-dark text-white rounded-4 h-100 overflow-hidden">
          <div class="ratio ratio-16x9">
            @php
              $url = str_replace('watch?v=', 'embed/', $video->url);
            @endphp
            <iframe src="{{ $url }}" title="{{ $video->judul }}" allowfullscreen class="rounded-top"></iframe>
          </div>
          <div class="card-body d-flex flex-column">
            <h5 class="card-title text-info">{{ $video->judul }}</h5>
            <p class="text-light small">{{ Str::limit($video->deskripsi, 100) }}</p>
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

{{-- STYLES --}}
<style>

  /* Tambahan untuk mengatur lebar PDF di laptop agar tidak besar */
.pdf-wrapper {
  max-width: 550px;
  margin: auto;
  text-align: center;
}
/* BUTTON STYLING */
button:focus {
  outline: none !important;
  box-shadow: 0 0 0 0.25rem rgba(14, 165, 233, 0.4);
}

.btn-primary {
  background: linear-gradient(135deg, #38bdf8, #0ea5e9);
  color: white;
  border: none;
  padding: 0.6rem 1.4rem;
  border-radius: 50px;
  font-weight: 600;
  transition: all 0.3s ease;
  box-shadow: 0 4px 12px rgba(14, 165, 233, 0.2);
}

.btn-primary:hover {
  background: linear-gradient(135deg, #0ea5e9, #0284c7);
  transform: translateY(-2px);
  box-shadow: 0 8px 24px rgba(14, 165, 233, 0.35);
}

.btn-danger {
  background: linear-gradient(135deg, #fb7185, #f43f5e);
  color: white;
  border: none;
  padding: 0.6rem 1.4rem;
  border-radius: 50px;
  font-weight: 600;
  transition: all 0.3s ease;
  box-shadow: 0 4px 12px rgba(244, 63, 94, 0.2);
}

.btn-danger:hover {
  background: linear-gradient(135deg, #f43f5e, #be123c);
  transform: translateY(-2px);
  box-shadow: 0 8px 24px rgba(244, 63, 94, 0.35);
}

.btn-outline-primary,
.btn-outline-success {
  border-width: 2px;
  font-weight: 600;
  padding: 0.5rem 1.2rem;
  border-radius: 50px;
  transition: all 0.3s ease;
}

.btn-outline-primary {
  border-color: #0ea5e9;
  color: #0ea5e9;
}

.btn-outline-primary:hover {
  background: #0ea5e9;
  color: white;
}

.btn-outline-success {
  border-color: #10b981;
  color: #10b981;
}

.btn-outline-success:hover {
  background: #10b981;
  color: white;
}

/* TEXT & TITLES */
.text-gradient {
  background: linear-gradient(90deg, #38bdf8, #0ea5e9);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
}

.card-title.text-info {
  color: #0ea5e9 !important;
}

.text-light {
  color: #cbd5e1 !important;
}

.text-muted {
  color: #64748b !important;
}

/* CARD (MATERI) */
.materi-card {
  background: #ffffff;
  border: 1px solid #e0f2fe;
  border-radius: 20px;
  box-shadow: 0 6px 20px rgba(56, 189, 248, 0.15);
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.materi-card:hover {
  transform: translateY(-6px);
  box-shadow: 0 12px 32px rgba(56, 189, 248, 0.25);
}

/* PDF CANVAS */
.pdf-canvas {
  width: 100%;
  max-width: 100%;
  border: 1px solid #e2e8f0;
  border-radius: 14px;
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
  margin-top: 1rem;
}

/* PDF CONTROLS */
.pdf-controls {
  display: flex;
  justify-content: center;
  flex-wrap: wrap;
  gap: 0.75rem;
  margin-top: 1rem;
}

.pdf-controls button {
  padding: 0.45rem 1rem;
  border-radius: 30px;
}

/* VIDEO */
.bg-gradient-dark {
  background: linear-gradient(135deg, #0f172a, #1e293b);
  border-radius: 20px;
}

iframe {
  width: 100%;
  height: auto;
  border: none;
  border-radius: 12px 12px 0 0;
}

/* ADDITIONAL RESPONSIVE TWEAKS */
@media (max-width: 576px) {
  .btn-primary,
  .btn-danger {
    width: 100%;
    margin-bottom: 0.75rem;
  }

  .pdf-controls {
    flex-direction: column;
    align-items: center;
  }
}

</style>
@endsection
