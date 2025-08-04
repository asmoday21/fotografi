@extends('guru.layouts.app')

@section('content')
<style>
  .text-gradient {
    background: linear-gradient(135deg, #00dfd8, #007cf0);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
  }

  .feature-card {
    background: linear-gradient(145deg, rgba(0, 124, 240, 0.2), rgba(0, 223, 216, 0.2));
    border: 1px solid rgba(255, 255, 255, 0.15);
    border-radius: 20px;
    backdrop-filter: blur(10px);
    transition: all 0.4s ease;
    position: relative;
    overflow: hidden;
    animation: fadeInUp 0.8s ease;
  }

  .feature-card:hover {
    transform: translateY(-8px) scale(1.03);
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.25);
  }

  .feature-card::after {
    content: "";
    position: absolute;
    top: -60%;
    left: -60%;
    width: 200%;
    height: 200%;
    background: radial-gradient(circle, rgba(0,255,255,0.1), transparent 70%);
    animation: rotateGlow 8s linear infinite;
    z-index: 0;
  }

  .feature-card h5 {
    font-size: 1.3rem;
    font-weight: 700;
    color: #fff;
    position: relative;
    z-index: 1;
  }

  .feature-card p {
    font-size: 0.95rem;
    color: #ddd;
    position: relative;
    z-index: 1;
  }

  .feature-card .fs-1 {
    animation: pulseIcon 2.5s infinite ease-in-out;
    z-index: 1;
    position: relative;
    color: #fff;
  }

  @keyframes fadeInUp {
    0% { opacity: 0; transform: translateY(20px); }
    100% { opacity: 1; transform: translateY(0); }
  }

  @keyframes pulseIcon {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.15); }
  }

  @keyframes rotateGlow {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
  }

  #tanggal, #jam {
    color: #fff;
    text-shadow: 0 1px 4px rgba(0, 0, 0, 0.6);
  }

  @media (max-width: 768px) {
    .feature-card {
      padding: 1.5rem;
    }

    .feature-card h5 {
      font-size: 1.15rem;
    }

    .feature-card p {
      font-size: 0.85rem;
    }
  }
</style>

<div class="container py-5 animate__animated animate__fadeIn">
  <div class="d-flex justify-content-between flex-wrap align-items-center mb-4">
    <div>
      <h2 class="fw-bold text-gradient display-5 mb-1 animate__animated animate__fadeInLeft">📘 Selamat Datang, Guru!</h2>
      <p class="text-white fs-5">Kelola semua konten pembelajaran dengan nyaman dan mudah.</p>
    </div>

    <div class="bg-white bg-opacity-10 p-4 rounded-4 mt-4 mb-5 border-start border-4 border-info text-white shadow-sm">
      <h5 class="fw-bold mb-3 text-info">
        <i class="fas fa-bullseye me-2"></i> Capaian Pembelajaran
      </h5>
      <ul class="ps-3 mb-0 small">
        <li>Menyiapkan materi dan kuis yang interaktif & edukatif.</li>
        <li>Memfasilitasi siswa dalam memahami teknik fotografi dasar.</li>
        <li>Mengembangkan kreativitas siswa melalui karya & objek 3D.</li>
        <li>Memantau dan mengevaluasi hasil belajar siswa.</li>
        <li>Mendorong kolaborasi dan eksplorasi digital secara aktif.</li>
      </ul>

      <div class="mt-4">
        <p class="fw-bold mb-2 text-white">Progress Penyusunan Materi & Kuis</p>

        <div class="mb-3">
          <p class="mb-1 small text-white">Materi Disusun: {{ $materiProgress ?? 0 }}%</p>
          <div class="progress" style="height: 16px;">
            <div class="progress-bar bg-info" role="progressbar"
                 style="width: {{ $materiProgress ?? 0 }}%;"
                 aria-valuenow="{{ $materiProgress ?? 0 }}" aria-valuemin="0" aria-valuemax="100">
              {{ $materiProgress ?? 0 }}%
            </div>
          </div>
        </div>

        <div>
          <p class="mb-1 small text-white">Kuis Disusun: {{ $kuisProgress ?? 0 }}%</p>
          <div class="progress" style="height: 16px;">
            <div class="progress-bar bg-warning text-dark" role="progressbar"
                 style="width: {{ $kuisProgress ?? 0 }}%;"
                 aria-valuenow="{{ $kuisProgress ?? 0 }}" aria-valuemin="0" aria-valuemax="100">
              {{ $kuisProgress ?? 0 }}%
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="text-end">
      <div id="tanggal" class="fw-semibold fs-6"></div>
      <div id="jam" class="fs-4 text-gradient fw-bold"></div>
    </div>
  </div>

  {{-- Fitur-fitur utama dashboard --}}
  <div class="row g-4">
    @php
      $fitur = [
        ['icon' => '📚', 'title' => 'Materi', 'desc' => 'Kelola & upload materi'],
        ['icon' => '📝', 'title' => 'Kuis', 'desc' => 'Kelola soal & nilai'],
        ['icon' => '🖼️', 'title' => 'Karya Siswa', 'desc' => 'Upload karya terbaik'],
        ['icon' => '🎥', 'title' => 'Video Tutorial', 'desc' => 'Tambahkan video pembelajaran'],
        ['icon' => '🧱', 'title' => 'Objek 3D', 'desc' => 'Objek pembelajaran interaktif'],
      ];
    @endphp

    @foreach($fitur as $f)
      <div class="col-lg-4 col-md-6">
        <div class="feature-card p-4 text-center h-100 shadow-lg">
          <div class="fs-1 mb-3">{{ $f['icon'] }}</div>
          <h5>{{ $f['title'] }}</h5>
          <p>{{ $f['desc'] }}</p>
        </div>
      </div>
    @endforeach
  </div>
</div>

@push('scripts')
<script>
  const hari = ['Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'];
  const bulan = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];

  function updateTanggalJam() {
    const now = new Date();
    const tanggal = `${hari[now.getDay()]}, ${now.getDate()} ${bulan[now.getMonth()]} ${now.getFullYear()}`;
    const jam = now.toLocaleTimeString('id-ID', { hour12: false });

    document.getElementById('tanggal').textContent = tanggal;
    document.getElementById('jam').textContent = jam;
  }

  setInterval(updateTanggalJam, 1000);
  updateTanggalJam();
</script>
@endpush
@endsection
