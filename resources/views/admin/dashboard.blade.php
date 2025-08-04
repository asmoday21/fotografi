<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Dashboard Admin - Fotografi DKV</title>

  <!-- Bootstrap & Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

  <style>
    body {
      font-family: 'Montserrat', sans-serif;
      background: linear-gradient(135deg, #0f2027, #203a43, #2c5364);
      color: #fff;
      overflow-x: hidden;
    }

    .sidebar {
      background: #121212;
      width: 260px;
      padding: 30px 20px;
      position: fixed;
      height: 100vh;
      box-shadow: 4px 0 25px rgba(0,0,0,0.4);
      text-align: center;
      z-index: 1000;
      transition: left 0.3s ease-in-out;
    }

    .sidebar img.logo {
      width: 80px;
      height: 80px;
      border-radius: 50%;
      border: 2px solid #fff;
      margin-bottom: 15px;
    }

    .sidebar h4 {
      font-size: 20px;
      font-weight: 700;
      margin-bottom: 25px;
      color: #fff;
    }

    .sidebar a {
      display: block;
      color: #ccc;
      padding: 12px 15px;
      margin-bottom: 10px;
      border-radius: 8px;
      font-weight: 600;
      text-decoration: none;
      transition: all 0.3s;
    }

    .sidebar a:hover,
    .sidebar a.active {
      background: rgba(255, 255, 255, 0.1);
      color: #fff;
      transform: translateX(4px);
    }

    .main-content {
      margin-left: 260px;
      padding: 40px 30px;
      transition: margin-left 0.3s ease;
    }

    .dashboard-heading h2 {
      font-size: 2rem;
      font-weight: 700;
      color: #ffcc00;
    }

    .dashboard-heading p {
      font-size: 1.1rem;
      font-weight: 500;
      color: #f0f0f0;
    }

    .datetime {
      font-size: 1rem;
      font-weight: bold;
      color: #00ffd5;
    }

    .card-box {
      background: rgba(255, 255, 255, 0.07);
      padding: 25px;
      border-radius: 20px;
      box-shadow: 0 8px 25px rgba(0,0,0,0.2);
      backdrop-filter: blur(8px);
      text-align: center;
      transition: all 0.4s ease-in-out;
      cursor: pointer;
    }

    .card-box:hover {
      transform: scale(1.05);
      background: rgba(255, 255, 255, 0.1);
    }

    .card-box i {
      font-size: 2.5rem;
      color: #ffd700;
      margin-bottom: 10px;
      display: block;
      animation: pulseIcon 2s infinite;
    }

    .card-box h5 {
      font-size: 1.3rem;
      font-weight: 700;
    }

    .card-box p {
      font-size: 0.95rem;
      color: #ccc;
    }

    @keyframes pulseIcon {
      0%, 100% { transform: scale(1); }
      50% { transform: scale(1.15); }
    }

    .btn-outline-light {
      font-weight: 600;
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

      .main-content.dimmed {
        filter: blur(2px);
      }
    }
    @keyframes fadeSlideUp {
  0% {
    opacity: 0;
    transform: translateY(30px);
  }
  100% {
    opacity: 1;
    transform: translateY(0);
  }
}

.card-box {
  opacity: 0;
  transform: translateY(30px);
  animation: none;
}

.card-box.animated {
  animation: fadeSlideUp 0.7s ease forwards;
}

.card-box:hover {
  box-shadow: 0 0 20px rgba(255, 255, 255, 0.2), 0 0 40px rgba(0, 255, 200, 0.3);
}

  </style>
</head>
<body>

<!-- Tombol hamburger HP -->
<button class="btn btn-warning d-md-none position-fixed top-0 start-0 m-3 z-3" onclick="toggleSidebar()" style="z-index: 1100;">
  <i class="bi bi-list fs-4"></i>
</button>

<div class="d-flex">
  <!-- Sidebar -->
  <div class="sidebar">
    <img src="{{ asset('assets/img/logo.jpg') }}" alt="Logo Sekolah" class="logo">
    <h4><i class="bi bi-speedometer2 me-2"></i>Admin Panel</h4>

    @php
      $cards = [
        ['icon' => 'bi-people-fill', 'title' => 'Users', 'route' => 'admin.users.index'],
        ['icon' => 'bi-journal-text', 'title' => 'Materi', 'route' => 'admin.materi.index'],
        ['icon' => 'bi-image', 'title' => 'Galeri', 'route' => 'admin.galeri.index'],
        ['icon' => 'bi-camera-video-fill', 'title' => 'Video', 'route' => 'admin.video-tutorial.index'],
      ['icon' => 'bi-box-seam', 'title' => 'Objek 3D', 'route' => 'admin.objek3d.index'],

      ];
    @endphp

    @foreach ($cards as $item)
      <a href="{{ route($item['route']) }}">
        <i class="bi {{ $item['icon'] }} me-2"></i>{{ $item['title'] }}
      </a>
    @endforeach

    <form method="POST" action="{{ route('logout') }}">
      @csrf
      <button class="btn btn-danger w-100 mt-3">
        <i class="bi bi-box-arrow-right me-2"></i>Logout
      </button>
    </form>

    <button class="btn btn-outline-light w-100 mt-4" onclick="toggleDarkMode()">
      <i class="bi bi-moon-stars-fill me-1"></i> Toggle Mode
    </button>
  </div>

  <!-- Main Content -->
  <div class="main-content">
    <div class="dashboard-heading mb-4">
      <h2>📸 Dashboard Admin Fotografi DKV</h2>
      <p>SMKN 1 PASAMAN</p>
      <div class="datetime" id="datetime"></div>
    </div>

    <!-- Statistik -->
    <div class="row g-3 mb-4">
      <div class="col-md-3">
        <div class="card bg-dark text-white shadow border-0">
          <div class="card-body">
            <h6><i class="bi bi-people-fill me-2"></i>Total Users</h6>
            <h4>{{ $users->count() }}</h4>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card bg-dark text-white shadow border-0">
          <div class="card-body">
            <h6><i class="bi bi-journal-text me-2"></i>Materi</h6>
            <h4>{{ $materi->count() }}</h4>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card bg-dark text-white shadow border-0">
          <div class="card-body">
            <h6><i class="bi bi-camera-video-fill me-2"></i>Video</h6>
            <h4>{{ $videos->count() }}</h4>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card bg-dark text-white shadow border-0">
          <div class="card-body">
            <h6><i class="bi bi-image me-2"></i>Galeri</h6>
            <h4>{{ $galeri->count() }}</h4>
          </div>
        </div>
      </div>
    </div>

    Menu Navigasi
    <div class="row g-4 dashboard-cards">
      @foreach ($cards as $item)
        <div class="col-md-4">
          <div class="card-box animate__animated animate__fadeInUp">
            <i class="bi {{ $item['icon'] }}"></i>
            <h5>{{ $item['title'] }}</h5>
            <p>Kelola menu {{ strtolower($item['title']) }}</p>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</div>                     

<!-- Tombol Tambah User -->
<a href="{{ route('admin.users.create') }}" class="btn btn-warning rounded-circle position-fixed bottom-0 end-0 m-4 shadow-lg" title="Tambah User">
  <i class="bi bi-plus fs-4"></i>
</a>

<!-- Script -->
<script>
  function toggleSidebar() {
    document.querySelector('.sidebar').classList.toggle('active');
    document.querySelector('.main-content').classList.toggle('dimmed');
  }

  function toggleDarkMode() {
    document.body.classList.toggle('dark-mode');
  }

  // Waktu real-time
  setInterval(() => {
    const now = new Date();
    const tanggal = now.toLocaleDateString('id-ID', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' });
    const jam = now.toLocaleTimeString('id-ID');
    document.getElementById('datetime').textContent = `${tanggal} - ${jam}`;
  }, 1000);


  // Fade-in card satu per satu saat halaman load
  document.addEventListener("DOMContentLoaded", () => {
    const cards = document.querySelectorAll(".card-box");
    cards.forEach((card, i) => {
      setTimeout(() => {
        card.classList.add("animated");
      }, i * 200); // delay bertahap
    });

    // Sidebar transition mobile auto-close jika klik luar
    document.addEventListener("click", function(e) {
      const sidebar = document.querySelector('.sidebar');
      const hamburger = document.querySelector('.bi-list');
      if (!sidebar.contains(e.target) && !hamburger.contains(e.target)) {
        sidebar.classList.remove('active');
        document.querySelector('.main-content').classList.remove('dimmed');
      }
    });

    // Judul dashboard animasi bounce sedikit
    const title = document.querySelector(".dashboard-heading h2");
    if (title) {
      title.style.transition = "transform 0.4s ease";
      title.addEventListener("mouseenter", () => title.style.transform = "scale(1.05)");
      title.addEventListener("mouseleave", () => title.style.transform = "scale(1)");
    }
  });


</script>

</body>
</html>
