<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title', 'Dashboard Guru')</title>

  <!-- Bootstrap & Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

  <!-- Animate.css -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

  <!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">


  <!-- Custom Styles -->
  <style>
    :root {
      --primary: #007cf0;
      --secondary: #1e1e2f;
      --gradient: linear-gradient(135deg, #007cf0, #0f2423);
      --text-light: #f1f1f1;
      --dark-bg: #121212;
      --light-bg: #f9f9fb;
    }

body {
    font-family: 'Poppins', sans-serif;
    background: linear-gradient(135deg, #137f8dff, #098a9bff, #4e94b3ff, #159fdfff);
    background-size: 400% 400%;
    animation: gradientBG 15s ease infinite;
    color: #212529; /* Teks gelap agar kontras */
    margin: 0;
}



    @keyframes gradientBG {
      0% {background-position: 0% 50%;}
      50% {background-position: 100% 50%;}
      100% {background-position: 0% 50%;}
    }

    .sidebar {
      width: 260px;
      background: rgba(8, 47, 70, 0.95);
      min-height: 100vh;
      box-shadow: 4px 0 12px rgba(0, 0, 0, 0.4);
      border-right: 1px solid #333;
    }

    .sidebar-header {
      padding: 25px 20px;
      text-align: center;
      border-bottom: 1px solid #444;
      background: rgba(0, 0, 0, 0.3);
    }

    .sidebar-header img {
      width: 65px;
      height: 65px;
      border-radius: 50%;
      object-fit: cover;
      margin-bottom: 10px;
    }

    .sidebar-header div {
      font-size: 1.2rem;
      font-weight: 600;
    }

    .sidebar a {
      display: flex;
      align-items: center;
      gap: 12px;
      padding: 14px 22px;
      color: #ccc;
      font-weight: 500;
      border-radius: 12px;
      margin: 6px 12px;
      transition: all 0.25s ease-in-out;
    }

    .sidebar a:hover,
    .sidebar a.active {
      background: var(--gradient);
      color: white;
      transform: translateX(6px);
    }

    .sidebar i {
      font-size: 1.2rem;
    }

    .content {
      flex-grow: 1;
      padding: 30px;
      animation: fadeIn 1s ease;
    }

    .theme-toggle {
      position: fixed;
      top: 14px;
      right: 20px;
      z-index: 1100;
    }

    .card {
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }

    .dark-mode {
      background-color: var(--dark-bg) !important;
      color: #fff !important;
    }

    .light-mode {
      background-color: var(--light-bg) !important;
      color: #000 !important;
    }

    @keyframes fadeIn {
      from {opacity: 0; transform: translateY(20px);}
      to {opacity: 1; transform: translateY(0);}
    }

    @media (max-width: 768px) {
      .sidebar {
        display: none;
      }
      .offcanvas-body .nav-link {
        color: #ccc;
        font-weight: 500;
      }
      .offcanvas-body .nav-link:hover {
        background-color: #444;
        color: white;
      }
    }

    @media (max-width: 576px) {
      h2, h4 {
        font-size: 1.25rem;
      }

      .btn {
        width: 100%;
        margin-bottom: 0.5rem;
      }
    }
  </style>
</head>
<body>

  <!-- Theme Toggle + Mobile Menu -->
  <div class="theme-toggle">
    <button onclick="toggleMode()" class="btn btn-outline-light btn-sm me-2">
      <i class="bi bi-circle-half"></i> Mode
    </button>
    <button class="btn btn-light btn-sm d-md-none" data-bs-toggle="offcanvas" data-bs-target="#sidebarMobile">
      <i class="bi bi-list"></i>
    </button>
  </div>

  <div class="d-flex">
    <!-- Sidebar Desktop -->
    <div class="sidebar d-none d-md-block">
      <div class="sidebar-header">
        <img src="{{ asset('assets/img/logo.jpg') }}" alt="Logo Sekolah">
        <div>👨‍🏫 <strong>Guru Panel</strong></div>
      </div>
      <nav class="nav flex-column mt-3">
        <a href="{{ route('guru.dashboard') }}" class="nav-link {{ request()->is('guru/dashboard') ? 'active' : '' }}"><i class="bi bi-house-door"></i> Dashboard</a>
        <a href="{{ route('guru.materi.index') }}" class="nav-link {{ request()->is('guru/materi*') ? 'active' : '' }}"><i class="bi bi-book-half"></i> Materi</a>
        <a href="{{ route('guru.kuis.index') }}" class="nav-link {{ request()->is('guru/kuis*') ? 'active' : '' }}"><i class="bi bi-pencil"></i> Soal Kuis</a>
        <a href="{{ route('guru.hasilkuis.index') }}" class="nav-link {{ request()->is('guru/hasilkuis*') ? 'active' : '' }}"><i class="bi bi-bar-chart-line-fill"></i> Hasil Kuis</a>
        <a href="{{ route('guru.galeri.index') }}" class="nav-link {{ request()->is('guru/galeri*') ? 'active' : '' }}"><i class="bi bi-image-fill"></i> Karya Siswa</a>
        <a href="{{ route('guru.video-tutorial.index') }}" class="nav-link {{ request()->is('guru/video-tutorial*') ? 'active' : '' }}"><i class="bi bi-camera-reels"></i> Video Tutorial</a>
        <a href="{{ route('guru.objek3d.index') }}" class="nav-link {{ request()->is('guru/objek3d*') ? 'active' : '' }}"><i class="bi bi-box"></i> Objek 3D</a>
      </nav>
      <form method="POST" action="{{ route('logout') }}" class="p-3 mt-4">
        @csrf
        <button type="submit" class="btn btn-danger w-100 rounded-pill animate__animated animate__fadeInUp">
          <i class="bi bi-box-arrow-right"></i> Keluar
        </button>
      </form>
    </div>

    <!-- Sidebar Mobile -->
    <div class="offcanvas offcanvas-start text-bg-dark" tabindex="-1" id="sidebarMobile">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title">👨‍🏫 Menu Guru</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
      </div>
      <div class="offcanvas-body">
        <a href="{{ route('guru.dashboard') }}" class="nav-link {{ request()->is('guru/dashboard') ? 'active' : '' }}"><i class="bi bi-house-door"></i> Dashboard</a>
        <a href="{{ route('guru.materi.index') }}" class="nav-link {{ request()->is('guru/materi*') ? 'active' : '' }}"><i class="bi bi-book-half"></i> Materi</a>
        <a href="{{ route('guru.kuis.index') }}" class="nav-link {{ request()->is('guru/kuis*') ? 'active' : '' }}"><i class="bi bi-pencil"></i> Soal Kuis</a>
        <a href="{{ route('guru.hasilkuis.index') }}" class="nav-link {{ request()->is('guru/hasilkuis*') ? 'active' : '' }}"><i class="bi bi-bar-chart-line-fill"></i> Hasil Kuis</a>
        <a href="{{ route('guru.galeri.index') }}" class="nav-link {{ request()->is('guru/galeri*') ? 'active' : '' }}"><i class="bi bi-image-fill"></i> Karya Siswa</a>
        <a href="{{ route('guru.video-tutorial.index') }}" class="nav-link {{ request()->is('guru/video-tutorial*') ? 'active' : '' }}"><i class="bi bi-camera-reels"></i> Video Tutorial</a>
        <a href="{{ route('guru.objek3d.index') }}" class="nav-link {{ request()->is('guru/objek3d*') ? 'active' : '' }}"><i class="bi bi-box"></i> Objek 3D</a>
        <form method="POST" action="{{ route('logout') }}" class="mt-4">
          @csrf
          <button type="submit" class="btn btn-danger w-100 rounded-pill"><i class="bi bi-box-arrow-right"></i> Keluar</button>
        </form>
      </div>
    </div>

    <!-- Main Content -->
    <div class="content animate__animated animate__fadeInUp">
      @yield('content')
    </div>
  </div>

  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    // Toggle Mode + Simpan ke LocalStorage
    function toggleMode() {
      const body = document.body;
      body.classList.toggle('dark-mode');
      body.classList.toggle('light-mode');
      localStorage.setItem('theme', body.classList.contains('dark-mode') ? 'dark' : 'light');
    }

    // Apply theme on load
    document.addEventListener("DOMContentLoaded", function () {
      const savedTheme = localStorage.getItem('theme');
      if (savedTheme === 'dark') {
        document.body.classList.add('dark-mode');
      } else {
        document.body.classList.add('light-mode');
      }
    });
  </script>

  @stack('scripts')
</body>
</html>
