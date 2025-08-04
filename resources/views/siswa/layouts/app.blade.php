<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>@yield('title', '📸 Dashboard Fotografi')</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSS Eksternal -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@500&family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">

  <!-- GSAP & WOW -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
  <script>new WOW().init();</script>

  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(to right, #e0f7ff, #ffffff);
    }
    .main-header {
      background: linear-gradient(to right, #0ea5e9, #0f172a);
      color: white;
    }
    .main-sidebar {
      background: linear-gradient(to bottom, #0ea5e9, #0284c7);
    }
    .main-sidebar .nav-link {
      color: white;
      transition: all 0.3s ease-in-out;
      position: relative;
    }
    .main-sidebar .nav-link:hover {
      background: rgba(255,255,255,0.1);
      transform: translateX(6px);
      box-shadow: 0 0 15px rgba(255, 255, 255, 0.3);
    }
    .nav-link::after {
      content: "";
      position: absolute;
      left: 0;
      bottom: 0;
      width: 100%;
      height: 2px;
      background: white;
      transform: scaleX(0);
      transform-origin: right;
      transition: transform 0.3s ease;
    }
    .nav-link:hover::after {
      transform: scaleX(1);
      transform-origin: left;
    }
    .content-wrapper {
      background: white;
      border-radius: 20px 20px 0 0;
      box-shadow: 0 -4px 20px rgba(0,0,0,0.05);
      animation: fadeInUp 0.6s ease;
    }
    @keyframes fadeInUp {
      from {opacity: 0; transform: translateY(20px);}
      to {opacity: 1; transform: translateY(0);}
    }
    .main-footer {
      background: #0ea5e9;
      color: white;
    }
    .btn-danger {
      background-color: #ef4444;
      border: none;
    }
    .btn-danger:hover {
      background-color: #dc2626;
    }
    #clock { font-weight: 600; font-size: 1rem; color: #fff; }
    #date { font-size: 0.9rem; color: #ffe57f; }
  </style>

  @yield('head')
</head>
<body class="hold-transition sidebar-mini layout-fixed text-sm">
  <!-- Splash Screen -->
  <div id="splash" style="position:fixed;z-index:9999;background:#0ea5e9;color:white;display:flex;align-items:center;justify-content:center;flex-direction:column;width:100%;height:100vh;">
    <div class="spinner-border text-light" style="width:3rem;height:3rem;" role="status"></div>
    <h4 class="mt-3">Memuat Dashboard...</h4>
  </div>

  <div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link text-white" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto align-items-center">
        <li class="nav-item d-none d-sm-inline text-right">
          <span id="clock"></span><br><span id="date"></span>
        </li>
        <li class="nav-item">
          <a id="toggleTheme" class="nav-link text-white" href="#" title="Ganti Tema">
            <i class="bi bi-moon-stars-fill" id="darkIcon"></i>
          </a>
        </li>
      </ul>
    </nav>

    <!-- Sidebar -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <a href="{{ url('/siswa/dashboard') }}" class="brand-link text-center bg-sky-500">
        <img src="{{ asset('assets/img/logo.jpg') }}" alt="Logo" class="brand-image img-circle elevation-3">
        <span class="brand-text font-weight-light">Dashboard Foto</span>
      </a>
      <div class="sidebar">
        <nav class="mt-3">
          <ul class="nav nav-pills nav-sidebar flex-column">
            <li class="nav-item"><a href="{{ url('/siswa/dashboard') }}" class="nav-link"><i class="bi bi-house-door nav-icon"></i><p>Beranda</p></a></li>
            <li class="nav-item"><a href="{{ url('/siswa/galeri/create') }}" class="nav-link"><i class="bi bi-upload nav-icon"></i><p>Upload Karya</p></a></li>
            <li class="nav-item"><a href="{{ route('siswa.objek3d.index') }}" class="nav-link"><i class="bi bi-box nav-icon"></i><p>Objek 3D</p></a></li>
            <li class="nav-item"><a href="{{ url('/siswa/materi') }}" class="nav-link"><i class="bi bi-journal-text nav-icon"></i><p>Materi Pelajaran</p></a></li>
            <li class="nav-item"><a href="{{ route('siswa.kuis.index') }}" class="nav-link"><i class="bi bi-question-circle nav-icon"></i><p>Kuis</p></a></li>
            <li class="nav-item"><a href="{{ route('siswa.hasilkuis.index') }}" class="nav-link"><i class="bi bi-bar-chart-line nav-icon"></i><p>Skor</p></a></li>
            <li class="nav-item mt-3">
              <form action="{{ route('logout') }}" method="POST">@csrf
                <button class="btn btn-danger btn-block btn-sm"><i class="bi bi-box-arrow-right me-1"></i> Logout</button>
              </form>
            </li>
          </ul>
        </nav>
      </div>
    </aside>

    <!-- Content Wrapper -->
    <div class="content-wrapper">
      <div class="content pt-4 px-3">
        @yield('content')
      </div>
    </div>

    <!-- Footer -->
    <footer class="main-footer text-sm text-center">
      <strong>&copy; {{ date('Y') }} Dashboard Fotografi.</strong> Powered by AdminLTE.
    </footer>
  </div>

  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>

  <script>
    const clock = () => {
      const now = new Date();
      const jam = String(now.getHours()).padStart(2, '0');
      const menit = String(now.getMinutes()).padStart(2, '0');
      const detik = String(now.getSeconds()).padStart(2, '0');
      const hari = ['Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'];
      const bulan = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
      document.getElementById('clock').textContent = `${jam}:${menit}:${detik}`;
      document.getElementById('date').textContent = `${hari[now.getDay()]}, ${now.getDate()} ${bulan[now.getMonth()]} ${now.getFullYear()}`;
    }
    setInterval(clock, 1000);
    clock();

    document.getElementById('toggleTheme').addEventListener('click', () => {
      document.body.classList.toggle('dark-mode');
      document.getElementById('darkIcon').classList.toggle('bi-moon-stars-fill');
      document.getElementById('darkIcon').classList.toggle('bi-sun-fill');
    });

    document.querySelector('[data-widget="pushmenu"]').addEventListener('click', () => {
      document.querySelector('.main-sidebar').classList.toggle('collapsed');
    });

    window.addEventListener("load", () => {
      gsap.to("#splash", {
        opacity: 0,
        duration: 0.5,
        delay: 1,
        onComplete: () => {
          document.getElementById("splash").style.display = "none";
        }
      });
    });

    gsap.from(".nav-item", {
      opacity: 0,
      x: -30,
      stagger: 0.1,
      duration: 0.6,
      ease: "power2.out"
    });
    gsap.from(".content-wrapper", {
      opacity: 0,
      y: 20,
      duration: 0.6,
      delay: 0.5,
      ease: "power2.out"
    });
  </script>
  @yield('scripts')
</body>
</html>
