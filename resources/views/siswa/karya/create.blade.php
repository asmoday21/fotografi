@extends('siswa.layouts.app')

@section('head')
<!-- Tambahan Library CSS & JS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/vanilla-tilt@1.7.2/dist/vanilla-tilt.min.js"></script>

<style>
  body {
    background: linear-gradient(to bottom right, #0f172a, #1e293b);
    font-family: 'Segoe UI', sans-serif;
  }
  .custom-upload-box {
    background: rgba(255, 255, 255, 0.05);
    backdrop-filter: blur(30px);
    box-shadow: 0 12px 50px rgba(0, 0, 0, 0.3);
    border: 1px solid rgba(255, 255, 255, 0.1);
    transition: 0.4s ease;
    animation: fadeInUp 0.6s ease;
  }
  .custom-upload-box:hover {
    box-shadow: 0 16px 60px rgba(59, 130, 246, 0.6);
    transform: scale(1.01);
  }
  .gradient-heading {
    background: linear-gradient(to right, #a855f7, #6366f1, #06b6d4);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
  }
  .form-control-style {
    background: rgba(255, 255, 255, 0.05);
    border: 1px solid rgba(255, 255, 255, 0.15);
    color: #f1f5f9;
    border-radius: 12px;
    transition: all 0.3s ease;
    font-weight: 500;
  }
  .form-control-style::placeholder {
    color: #e2e8f0;
    font-style: italic;
  }
  .form-control-style:focus {
    background-color: rgba(255, 255, 255, 0.08);
    border-color: #7dd3fc;
    box-shadow: 0 0 0 4px rgba(125, 211, 252, 0.2);
  }
  label {
    color: #e0f2fe;
  }
  @keyframes fadeInUp {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
  }
</style>
@endsection

@section('content')
<div class="container py-5 px-3">
  <div class="custom-upload-box rounded-4 p-5 text-white mx-auto shadow-lg" style="max-width: 720px;" data-tilt data-aos="fade-up">

    <h2 class="text-center fs-2 fw-bold gradient-heading mb-4 animate__animated animate__fadeInDown">
      🎨 Upload Karya Digital Terbaikmu
    </h2>

    {{-- Notifikasi sukses --}}
    @if(session('success'))
      <div class="alert alert-success alert-dismissible fade show" role="alert" data-aos="fade-down">
        ✅ {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
      </div>
    @endif

    {{-- Preview upload --}}
    @php $latest = session('latest'); @endphp
    @if($latest)
      <div class="mb-4 border border-white/10 p-3 rounded shadow-sm bg-white/10" data-aos="zoom-in">
        <h5 class="text-info">{{ $latest['judul'] }}</h5>
        <p class="small text-light">{{ $latest['deskripsi'] }}</p>

        @if(Str::endsWith($latest['file'], ['.mp4', '.webm', '.mov']))
          <video class="w-100 rounded" controls>
            <source src="{{ asset('storage/' . $latest['file']) }}">
            Browser tidak mendukung video.
          </video>
        @else
          <img src="{{ asset('storage/' . $latest['file']) }}" class="w-100 rounded border border-light mt-2" alt="Preview">
        @endif
      </div>
    @endif

    {{-- Form --}}
    <form action="{{ route('siswa.galeri.store') }}" method="POST" enctype="multipart/form-data" class="mt-4" data-aos="fade-up" data-aos-delay="200">
      @csrf

      <div class="mb-3">
        <label for="judul" class="form-label">🖋️ Judul Karya</label>
        <input type="text" name="judul" id="judul" class="form-control form-control-style @error('judul') is-invalid @enderror" placeholder="Contoh: Matahari Senja di Bukit" value="{{ old('judul') }}" required>
        @error('judul')
          <div class="text-danger small mt-1">{{ $message }}</div>
        @enderror
      </div>

      <div class="mb-3">
        <label for="deskripsi" class="form-label">📝 Deskripsi</label>
        <textarea name="deskripsi" id="deskripsi" rows="4" class="form-control form-control-style @error('deskripsi') is-invalid @enderror" placeholder="Ceritakan kisah di balik karyamu..." required>{{ old('deskripsi') }}</textarea>
        @error('deskripsi')
          <div class="text-danger small mt-1">{{ $message }}</div>
        @enderror
      </div>

      <div class="mb-4">
        <label for="file" class="form-label">📁 Unggah File (Gambar/Video max 10MB)</label>
        <input type="file" name="file" id="file" accept="image/*,video/*" class="form-control form-control-style @error('file') is-invalid @enderror" required>
        @error('file')
          <div class="text-danger small mt-1">{{ $message }}</div>
        @enderror
      </div>

      <div class="text-center">
        <button type="submit" class="btn btn-lg btn-primary px-5 py-2 rounded-pill fw-bold shadow-sm" style="background: linear-gradient(to right, #22d3ee, #6366f1, #a855f7);" data-aos="zoom-in" data-aos-delay="300">
          🚀 Upload Sekarang
        </button>
      </div>
    </form>
  </div>
</div>

<!-- JS Boostrap, AOS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
<script>
  AOS.init();
  VanillaTilt.init(document.querySelectorAll("[data-tilt]"), {
    max: 10,
    speed: 400,
    glare: true,
    "max-glare": 0.3,
  });
</script>
@endsection
