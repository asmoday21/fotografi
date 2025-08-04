@extends('siswa.layouts.app')

@section('content')

<!-- AOS Scroll & Animate.css -->
<link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
<script>AOS.init();</script>

<!-- Custom Enhanced Style -->
<style>
  .text-gradient {
    background: linear-gradient(to right, #38bdf8, #818cf8);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
  }

  .glass-card {
    background: rgba(255, 255, 255, 0.05);
    backdrop-filter: blur(12px);
    border-radius: 20px;
    box-shadow: 0 8px 30px rgba(0,0,0,0.2);
    padding: 2rem;
    overflow: hidden;
  }

  .table-glass {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0 0.75rem;
    font-size: 0.95rem;
    color: #f1f5f9;
  }

  .table-glass th {
    background: linear-gradient(to right, #3b82f6, #6366f1, #ec4899);
    color: #fff;
    padding: 1rem;
    font-size: 0.75rem;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    border-radius: 0.75rem;
    text-align: center;
  }

  .table-glass td {
    background: rgba(12, 74, 110, 0.8);
    padding: 1rem;
    border-radius: 0.75rem;
    transition: all 0.3s ease-in-out;
    text-align: center;
  }

  .table-glass tr:hover td {
    background: rgba(2, 132, 199, 0.9);
    color: #ffffff;
    transform: scale(1.01);
  }

  .table-glass td:first-child {
    border-top-left-radius: 0.75rem;
    border-bottom-left-radius: 0.75rem;
    text-align: left;
  }

  .table-glass td:last-child {
    border-top-right-radius: 0.75rem;
    border-bottom-right-radius: 0.75rem;
  }

  .nilai-highlight {
    color: #86efac;
    font-weight: 700;
    text-shadow: 0 0 8px rgba(132, 204, 22, 0.6);
  }

  .no-data-box {
    background: rgba(255, 255, 255, 0.07);
    backdrop-filter: blur(10px);
    padding: 2rem;
    border-radius: 1rem;
    box-shadow: 0 8px 20px rgba(0,0,0,0.1);
  }

</style>

<div class="min-vh-100 py-5 px-4" style="background: linear-gradient(to bottom right, #e0f7ff, #fef9ff);">
  <div class="container">

    <!-- Judul -->
    <div class="text-center mb-5" data-aos="fade-down" data-aos-duration="1000">
      <h2 class="display-5 fw-bold text-gradient animate__animated animate__fadeInDown">
        📊 Hasil Kuis Saya
      </h2>
      <p class="text-secondary mt-2">Lihat pencapaian dan skor dari kuis yang telah kamu selesaikan!</p>
    </div>

    <!-- Jika Tidak Ada Data -->
    @if($hasil->isEmpty())
      <div class="no-data-box text-center animate__animated animate__zoomIn">
        <i class="bi bi-info-circle-fill text-primary display-4 mb-3 animate__animated animate__tada animate__infinite"></i>
        <p class="h5 fw-semibold">Belum ada hasil kuis yang tersedia.</p>
      </div>

    @else
    <!-- Jika Ada Data -->
    <div class="glass-card animate__animated animate__fadeInUp" data-aos="fade-up" data-aos-delay="300">
      <div class="table-responsive">
        <table class="table-glass">
          <thead>
            <tr>
              <th>Judul Kuis</th>
              <th>Nilai</th>
              <th>Waktu</th>
            </tr>
          </thead>
          <tbody>
            @foreach($hasil as $item)
              <tr>
                <td>{{ $item->kuis->judul }}</td>
                <td class="nilai-highlight">{{ $item->nilai }}</td>
                <td>{{ $item->created_at->format('d M Y - H:i') }}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
    @endif

  </div>
</div>
@endsection
