<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Detail Objek 3D - Premium</title>

  {{-- Bootstrap & Icons --}}
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

  {{-- Google Fonts --}}
  <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@500;700&display=swap" rel="stylesheet">

  {{-- Model Viewer --}}
  <script type="module" src="https://unpkg.com/@google/model-viewer/dist/model-viewer.min.js"></script>

  <style>
    * {
      box-sizing: border-box;
    }

    body {
      margin: 0;
      padding-top: 60px;
      background: linear-gradient(135deg, #0f2027, #203a43, #2c5364);
      font-family: 'Orbitron', sans-serif;
      color: #fff;
      min-height: 100vh;
      background-attachment: fixed;
    }

    .container-glass {
      background: rgba(255, 255, 255, 0.05);
      border: 1px solid rgba(255, 255, 255, 0.1);
      border-radius: 20px;
      padding: 2rem;
      backdrop-filter: blur(20px);
      box-shadow: 0 20px 60px rgba(0, 0, 0, 0.4);
      animation: slideUp 0.8s ease-out;
    }

    @keyframes slideUp {
      from {
        opacity: 0;
        transform: translateY(40px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .btn-back {
      position: fixed;
      top: 20px;
      left: 20px;
      background: rgba(255, 255, 255, 0.1);
      border: none;
      color: #00d4ff;
      padding: 10px 16px;
      border-radius: 30px;
      font-weight: 600;
      text-decoration: none;
      z-index: 999;
      transition: all 0.3s ease;
    }

    .btn-back:hover {
      background: rgba(255, 255, 255, 0.2);
    }

    model-viewer {
      width: 100%;
      height: 480px;
      border-radius: 15px;
      background: #1c1c1c;
      margin-bottom: 1.5rem;
      border: 2px solid rgba(255,255,255,0.08);
    }

    .judul-karya {
      font-size: 2rem;
      font-weight: 700;
      background: linear-gradient(to right, #0ff, #8a2be2);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      text-align: center;
      margin-bottom: 1rem;
    }

    .deskripsi {
      font-size: 1rem;
      color: #ccd6f6;
      line-height: 1.7;
      padding: 0.5rem 0;
    }

    .upload-info {
      font-size: 0.85rem;
      color: #9ca3af;
      text-align: right;
      margin-top: 2rem;
    }

    @media (max-width: 768px) {
      model-viewer {
        height: 320px;
      }

      .judul-karya {
        font-size: 1.5rem;
      }
    }
  </style>
</head>
<body>

<a href="{{ route('siswa.objek3d.index') }}" class="btn-back">
  <i class="bi bi-arrow-left"></i> Kembali
</a>

<div class="container">
  <div class="row justify-content-center">
    <div class="col-lg-10 col-xl-8">
      <div class="container-glass">
        <h1 class="judul-karya">{{ $objek3d->judul }}</h1>

        <model-viewer
          src="{{ asset('storage/' . $objek3d->file) }}"
          alt="Objek 3D"
          auto-rotate
          camera-controls
          shadow-intensity="1"
          ar
          autoplay
          ios-src="{{ asset('storage/' . $objek3d->file) }}">
        </model-viewer>

        <h5 class="fw-semibold mb-2 text-info">📄 Deskripsi Karya</h5>
        <p class="deskripsi">{{ $objek3d->deskripsi }}</p>

        <div class="upload-info">
          <i class="bi bi-calendar3 me-1"></i>Diunggah pada: {{ $objek3d->created_at->format('d M Y, H:i') }}
        </div>
      </div>
    </div>
  </div>
</div>

{{-- Bootstrap --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
