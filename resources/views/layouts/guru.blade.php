<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Guru Panel</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #f5f6fa;
    }
    .sidebar {
      height: 100vh;
      background-color: #343a40;
    }
    .sidebar a {
      color: #fff;
      padding: 12px;
      display: block;
      text-decoration: none;
    }
    .sidebar a:hover {
      background-color: #495057;
    }
    .content {
      padding: 20px;
    }
  </style>
</head>
<body>
<div class="d-flex">
  <div class="sidebar p-3">
    <h4 class="text-white">Guru Panel</h4>
    <a href="{{ route('guru.dashboard') }}">🏠 Dashboard</a>
    <a href="{{ route('guru.materi.index') }}">📚 Materi</a>
    <a href="{{ route('guru.kuis.index') }}">📝 Soal Kuis</a>
    <a href="{{ route('guru.hasilkuis.index') }}">📊 Hasil Kuis</a>
    <a href="{{ route('guru.galeri.index') }}">🖼️ Karya Siswa</a>
    <a href="{{ route('guru.video-tutorial.index') }}">🎥 Video Tutorial</a>
    <a href="{{ route('guru.objek3d.index') }}">🧱 Objek 3D</a>
    <!-- <a href="{{ route('guru.kamera3d.index') }}">📷 Kamera 3D</a> -->
    <form method="POST" action="{{ route('logout') }}" class="d-inline">
      @csrf
      <button type="submit" class="btn btn-outline-danger btn-sm rounded-pill shadow-sm px-3 py-1 mt-3 d-flex align-items-center gap-1" style="border-width: 1.5px;">
        <i class="bi bi-box-arrow-right"></i> Logout
      </button>
    </form>
  </div>

  <div class="content flex-grow-1">
    @yield('content')
  </div>
</div>
</body>
</html>
