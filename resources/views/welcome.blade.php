<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Media Fotografi | Selamat Datang</title>

  <!-- Fonts & Icons -->
  <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;700&display=swap" rel="stylesheet"/>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet"/>
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet"/>

 <style>
  :root {
    --primary: #00aaff;
    --primary-hover: #0090dd;
    --bg-light: #e6f7ff;
    --bg-dark: #0f172a;
    --text-dark: #1e293b;
    --text-light: #ffffff;
    --shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
    --glass: rgba(255, 255, 255, 0.1);
    --blur: 10px;
  }

  html {
    scroll-behavior: smooth;
    font-size: 16px;
  }

  body {
    font-family: 'Raleway', sans-serif;
    background-color: var(--bg-light);
    color: var(--text-dark);
    margin: 0;
    padding: 0;
    overflow-x: hidden;
  }

  /* NAVBAR */
  .navbar {
    position: fixed;
    top: 0;
    width: 100%;
    background: var(--glass);
    backdrop-filter: blur(var(--blur));
    box-shadow: var(--shadow);
    z-index: 999;
    padding: 0.8rem 1.5rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
  }

  .navbar a {
    color: var(--text-light);
    text-decoration: none;
    margin-left: 1rem;
    font-weight: 500;
    transition: color 0.3s ease;
  }

  

  .navbar a:hover,
  .navbar a.active {
    color: var(--primary);
  }

  /* MASTHEAD */
  .masthead {
    height: 100vh;
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    padding: 2rem;
    color: var(--text-light);
  }

  .masthead video {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    filter: brightness(50%);
    z-index: -1;
  }

  .masthead h1 {
    font-size: 3rem;
    margin-bottom: 1rem;
  }

  .masthead p {
    font-size: 1.2rem;
    max-width: 600px;
  }

  /* BUTTON */
  .btn-primary-custom {
    background-color: var(--primary);
    color: var(--text-light);
    border: none;
    padding: 0.75rem 2rem;
    border-radius: 30px;
    font-weight: 600;
    font-size: 1rem;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: 0 8px 24px rgba(0, 170, 255, 0.3);
    margin-top: 1rem;
  }

  .btn-primary-custom:hover {
    background-color: var(--text-light);
    color: var(--primary);
    transform: translateY(-3px);
    box-shadow: 0 12px 32px rgba(0, 170, 255, 0.5);
  }

  /* SECTION TITLE */
  .section-title {
    text-align: center;
    color: var(--primary);
    font-size: 2rem;
    font-weight: 700;
    margin-top: 4rem;
    position: relative;
  }

  .section-title::after {
    content: '';
    display: block;
    width: 80px;
    height: 4px;
    background: var(--primary);
    margin: 10px auto 0;
    border-radius: 2px;
  }

  /* FEATURE CARD */
  .feature-card {
    background: #ffffff;
    border-radius: 20px;
    padding: 2rem;
    margin: 1rem;
    box-shadow: var(--shadow);
    transition: 0.4s ease;
    text-align: center;
    flex: 1;
    min-width: 250px;
  }

  .feature-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 30px rgba(0, 170, 255, 0.2);
  }

  /* CONTAINER FLEX */
  .flex-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 1.5rem;
    padding: 2rem 1rem;
  }

  /* FORM INPUT */
  .form-control {
    width: 100%;
    padding: 0.75rem 1rem;
    border: 2px solid transparent;
    border-radius: 12px;
    margin-top: 1rem;
    box-shadow: var(--shadow);
    transition: border 0.3s ease, box-shadow 0.3s ease;
  }

  .form-control:focus {
    border-color: var(--primary);
    outline: none;
    box-shadow: 0 0 0 0.2rem rgba(0, 170, 255, 0.25);
  }

  /* FOOTER */
  footer {
    background: var(--bg-dark);
    color: #ccc;
    padding: 2rem 1rem;
    text-align: center;
  }

  footer i {
    color: var(--primary);
  }

  /* RESPONSIVE DESIGN */
  @media (max-width: 992px) {
    .masthead h1 {
      font-size: 2.5rem;
    }

    .navbar {
      flex-direction: column;
      gap: 0.5rem;
    }
  }

  @media (max-width: 768px) {
    .masthead h1 {
      font-size: 2rem;
    }

    .feature-card {
      min-width: 100%;
    }

    .btn-primary-custom {
      padding: 0.6rem 1.5rem;
      font-size: 0.95rem;
    }
  }

  @media (max-width: 576px) {
    html {
      font-size: 14px;
    }

    .navbar a {
      margin-left: 0.5rem;
    }

    .masthead {
      padding: 1rem;
    }
  }
</style>

</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark fixed-top">
  <div class="container">
    <a class="navbar-brand fw-bold text-warning" href="#">
      <i class="bi bi-camera-fill me-1"></i>Media Fotografi
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto me-3">
        <li class="nav-item">
          <a class="nav-link active" href="#home">Beranda</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#about">Tentang Kami</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#features">Fitur</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#kontak">Kontak</a>
        </li>
      </ul>
      <a href="{{ route('login') }}" class="btn btn-outline-warning rounded-pill ms-lg-2">Login</a>
    </div>
  </div>
</nav>

<!-- Masthead -->
<header class="masthead position-relative" style="height: 100vh; overflow: hidden;">
  <video autoplay muted loop playsinline class="position-absolute w-100 h-100 object-fit-cover" style="z-index: -1; top: 0; left: 0;">
    <source src="{{ asset('assets/img/video.mp4') }}" type="video/mp4">
  </video>
  <div class="container h-100 d-flex flex-column justify-content-center align-items-center text-center text-white position-relative">
    <h1 class="display-4 fw-bold">Temukan Cerita di Balik Lensa</h1>
    <p class="lead">Selamat Datang di Media Pembelajaran Fotografi</p>
    <a href="{{ route('login') }}" class="btn btn-primary-custom mt-4">Gabung Sekarang</a>
  </div>
</header>

<!-- Features -->
<section id="features" class="container py-5">
  <h2 class="section-title mb-5" data-aos="fade-up">✨ Fitur Unggulan</h2>
  <div class="row">
    @php
      $features = [
        ['icon' => '📘', 'title' => 'Materi Interaktif', 'desc' => 'Belajar dari teks, video & elemen visual menarik.'],
        ['icon' => '❓', 'title' => 'Kuis Dinamis', 'desc' => 'Latihan mandiri dengan soal dan feedback otomatis.'],
        ['icon' => '🖼️', 'title' => 'Galeri Karya', 'desc' => 'Pamerkan hasil siswa dalam tampilan visual memukau.'],
        ['icon' => '🎥', 'title' => 'Video Edukatif', 'desc' => 'Penjelasan guru dalam bentuk video berkualitas.'],
        ['icon' => '📦', 'title' => 'Objek 3D', 'desc' => 'Jelajahi objek 3D dalam materi desain & multimedia.'],
        ['icon' => '👤', 'title' => 'Manajemen Akun', 'desc' => 'Kelola akun guru dan siswa dengan mudah.'],
      ];
    @endphp

    @foreach ($features as $feature)
      <div class="col-md-4 mb-4" data-aos="zoom-in-up">
        <div class="feature-card text-center h-100">
          <div style="font-size: 2.5rem;">{{ $feature['icon'] }}</div>
          
          <h5 class="mt-3">{{ $feature['title'] }}</h5>
          <p class="text-muted">{{ $feature['desc'] }}</p>
        </div>
      </div>
    @endforeach
  </div>
</section>

<!-- About Section -->
<section id="about" class="py-5 bg-light" data-aos="fade-up">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-md-6 mb-4 mb-md-0">
        <img src="{{ asset('assets/img/foto.jpg') }}" alt="Tentang Kami" class="img-fluid rounded shadow">
      </div>
      <div class="col-md-6">
        <h2 class="fw-bold mb-3 text-warning">Tentang Media Fotografi</h2>
        <p class="text-muted">Media Fotografi adalah platform pembelajaran interaktif berbasis visual untuk memperkenalkan dunia fotografi kepada siswa. Kami menghadirkan materi, galeri karya, video pembelajaran, dan objek 3D yang dapat diakses oleh siapa saja.</p>
        <p class="text-muted">Didukung oleh tenaga pendidik berpengalaman dan sistem akun siswa yang dinamis, kami hadir untuk membentuk kreativitas melalui lensa kamera.</p>
      </div>
    </div>
  </div>
</section>

<!-- Kontak Section -->
<!-- Kontak Section -->
<section id="kontak" class="py-5 text-light fade-in position-relative" style="overflow: hidden;">
  <video autoplay muted loop playsinline class="position-absolute w-100 h-100 object-fit-cover" style="z-index: -1; top: 0; left: 0;">
    <source src="{{ asset('assets/img/video2.mp4') }}" type="video/mp4">
  </video>
  <div class="container position-relative">
    <div class="text-center mb-5">
      <h2 class="fw-bold text-warning">Hubungi Kami</h2>
      <p class="text-light">Ada pertanyaan atau saran? Kami siap membantu Anda.</p>
    </div>
    <div class="row g-5">
      <div class="col-md-6">
        <div class="bg-secondary bg-opacity-75 rounded-4 p-4 h-100 shadow-sm">
          <h5><i class="bi bi-geo-alt-fill me-2 text-warning"></i>Alamat</h5>
          <p class="mb-4">Jl. Pertanian, Nagari Sukomanati, Aua Kuniang, Kec. Pasaman, Kabupaten Pasaman Barat, Sumatera Barat</p>
          <h5><i class="bi bi-envelope-fill me-2 text-warning"></i>Email</h5>
          <p class="mb-4">mediafotografi@sekolah.sch.id</p>
          <h5><i class="bi bi-telephone-fill me-2 text-warning"></i>Telepon</h5>
          <p class="mb-0">+62 812-3456-7890</p>
        </div>
      </div>
      <div class="col-md-6">
        <form class="bg-light text-dark p-4 rounded-4 shadow-sm">
          <div class="mb-3">
            <label for="name" class="form-label">Nama</label>
            <input type="text" class="form-control" id="name" placeholder="Masukkan nama Anda">
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" placeholder="Masukkan email Anda">
          </div>
          <div class="mb-3">
            <label for="message" class="form-label">Pesan</label>
            <textarea class="form-control" id="message" rows="4" placeholder="Tulis pesan Anda..."></textarea>
          </div>
          <div class="text-end">
            <button type="submit" class="btn btn-warning rounded-pill px-4">Kirim Pesan <i class="bi bi-send ms-1"></i></button>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>



<!-- Footer -->
<footer>
  <p>&copy; {{ date('Y') }} Media Fotografi. Dibuat dengan <i class="bi bi-heart-fill"></i> oleh MS Team</p>
</footer>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
  AOS.init({ duration: 1000, once: true });
</script>
</body>
</html>
