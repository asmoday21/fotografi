<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <title>@yield('title', 'Dashboard Admin')</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  {{-- Bootstrap, Icons --}}
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <style>
    * {
      font-family: 'Poppins', sans-serif;
    }

    body {
      margin: 0;
      padding: 0;
      overflow-x: hidden;
      background: linear-gradient(to right, #cceeff, #e0f7ff);
    }

    .bg-video {
      position: fixed;
      right: 0;
      bottom: 0;
      min-width: 100%;
      min-height: 100%;
      z-index: -2;
      object-fit: cover;
    }

    .bg-overlay {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(240, 248, 255, 0.85);
      backdrop-filter: blur(3px);
      z-index: -1;
    }

    .sidebar {
      width: 250px;
      position: fixed;
      top: 0;
      left: 0;
      height: 100%;
      background: #009fe3;
      color: white;
      padding: 20px;
      transition: all 0.3s;
      z-index: 100;
    }

    .sidebar h4 {
      font-weight: 600;
      margin-bottom: 30px;
      text-align: center;
    }

    .sidebar a {
      display: block;
      color: white;
      text-decoration: none;
      padding: 10px 15px;
      border-radius: 8px;
      margin-bottom: 10px;
      transition: 0.3s;
    }

    .sidebar a:hover,
    .sidebar a.active {
      background: #ffffff33;
    }

    .main-content {
      margin-left: 260px;
      padding: 20px;
    }

    .topbar {
      background: #87cefa;
      padding: 15px 20px;
      border-radius: 12px;
      margin-bottom: 20px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
    }

    .topbar h6 {
      margin: 0;
      font-weight: 500;
      color: #004e7c;
    }

    .topbar .btn-outline-light {
      border-color: #fff;
      color: #fff;
    }

    .topbar .btn-outline-light:hover {
      background: #ffffff33;
    }

    button.toggle-btn {
      background: none;
      border: none;
      font-size: 24px;
      color: #004e7c;
    }

    .btn-danger {
      background-color: #dc3545;
      border: none;
    }

    .btn-danger:hover {
      background-color: #c82333;
    }

    /* Responsive */
    @media (max-width: 768px) {
      .sidebar {
        left: -260px;
      }

      .sidebar.active {
        left: 0;
      }

      .main-content {
        margin-left: 0;
      }
    }
  </style>
</head>
<body class="dark">

  {{-- Background Video --}}
  <!-- <video autoplay muted loop playsinline class="bg-video">
    <source src="{{ asset('assets/img/siswa.mp4') }}" type="video/mp4" />
    Browser anda tidak mendukung video.
  </video> -->
  <div class="bg-overlay"></div>

  {{-- Sidebar --}}
  <div class="sidebar" id="sidebarMenu">
    <h4><i class="bi bi-speedometer2 me-2"></i>Admin Panel</h4>
    <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"><i class="bi bi-house-door"></i> Dashboard</a>
    <a href="{{ route('admin.users.index') }}" class="{{ request()->routeIs('admin.users.*') ? 'active' : '' }}"><i class="bi bi-people"></i> Users</a>
    <a href="{{ route('admin.materi.index') }}" class="{{ request()->routeIs('admin.materi.*') ? 'active' : '' }}"><i class="bi bi-journal-text"></i> Materi</a>
    <a href="{{ route('admin.komentar.index') }}" class="{{ request()->routeIs('admin.komentar.*') ? 'active' : '' }}"><i class="bi bi-chat-dots"></i> Komentar Materi</a>
    <!-- <a href="{{ route('admin.kuis.index') }}" class="{{ request()->routeIs('admin.kuis.*') ? 'active' : '' }}"><i class="bi bi-question-circle"></i> Kuis</a> -->
    <a href="{{ route('admin.galeri.index') }}" class="{{ request()->routeIs('admin.galeri.*') ? 'active' : '' }}"><i class="bi bi-image"></i> Galeri</a>
    <a href="{{ route('admin.video-tutorial.index') }}" class="{{ request()->routeIs('admin.video-tutorial.*') ? 'active' : '' }}"><i class="bi bi-camera-video"></i> Video</a>
    <a href="{{ route('admin.objek3d.index') }}" class="{{ request()->routeIs('admin.objek3d.*') ? 'active' : '' }}"><i class="bi bi-cube"></i> Objek 3D</a>

    <form action="{{ route('logout') }}" method="POST" class="mt-3">
      @csrf
      <button class="btn btn-danger w-100"><i class="bi bi-box-arrow-right me-2"></i> Logout</button>
    </form>
  </div>

  {{-- Main Content --}}
  <div class="main-content">
    {{-- Topbar --}}
    <div class="topbar">
      <button class="toggle-btn" onclick="toggleSidebar()">
        <i class="bi bi-list"></i>
      </button>
      <div class="d-flex align-items-center gap-2">
        <h6 class="mb-0">@yield('title', 'Dashboard')</h6>
        <button class="btn btn-sm btn-outline-light ms-3" onclick="toggleTheme()">
          <i class="bi bi-moon-stars-fill" id="themeIcon"></i>
        </button>
      </div>
    </div>

    @yield('content')
  </div>

  {{-- JS Theme Toggle --}}
  <script>
    function toggleSidebar() {
      document.getElementById('sidebarMenu').classList.toggle('active');
    }

    function toggleTheme() {
      const body = document.body;
      const icon = document.getElementById('themeIcon');
      const isDark = body.classList.contains('dark');

      if (isDark) {
        body.classList.replace('dark', 'light');
        icon.classList.replace('bi-moon-stars-fill', 'bi-brightness-high-fill');
        localStorage.setItem('theme', 'light');
      } else {
        body.classList.replace('light', 'dark');
        icon.classList.replace('bi-brightness-high-fill', 'bi-moon-stars-fill');
        localStorage.setItem('theme', 'dark');
      }
    }

    window.onload = () => {
      const savedTheme = localStorage.getItem('theme');
      if (savedTheme) {
        document.body.classList.remove('light', 'dark');
        document.body.classList.add(savedTheme);
        const icon = document.getElementById('themeIcon');
        if (savedTheme === 'light') {
          icon.classList.replace('bi-moon-stars-fill', 'bi-brightness-high-fill');
        } else {
          icon.classList.replace('bi-brightness-high-fill', 'bi-moon-stars-fill');
        }
      }
    };
  </script>

  @stack('scripts')
</body>
</html>
