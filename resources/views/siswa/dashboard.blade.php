@extends('siswa.layouts.app')

@section('content')
<!-- Animate.css, FontAwesome, Google Fonts, GSAP, WOW.js -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@700&display=swap" rel="stylesheet" />

<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
<script>new WOW().init();</script>

<style>
 body {
  font-family: 'Poppins', sans-serif;
  background: linear-gradient(145deg, #0f0f0f, #1a1a1a);
  color: #fff;
  overflow-x: hidden;
}

#hero-header {
  position: relative;
  min-height: 30vh;
  padding: 60px 20px;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  background: linear-gradient(135deg, #0a94cf, #203a43, #2c5364);
  background-size: 400% 400%;
  animation: gradientShift 15s ease infinite;
  text-align: center;
  z-index: 1;
  border-radius: 20px;
}

@keyframes gradientShift {
  0% { background-position: 0% 50%; }
  50% { background-position: 100% 50%; }
  100% { background-position: 0% 50%; }
}

#hero-header h1 {
  font-size: clamp(1.5rem, 5vw, 2.8rem);
  font-weight: 800;
  background: linear-gradient(90deg, #ffc107, #ff3d00, #00c9ff);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  text-shadow: 2px 2px 5px rgba(255, 255, 255, 0.1);
}

#typewriter {
  font-size: clamp(1rem, 2.5vw, 1.4rem);
  font-weight: 500;
  color: #fff;
  opacity: 0.9;
}

.text-glow {
  text-shadow: 0 0 10px #00e0ff, 0 0 20px #00e0ff;
  color: #00e0ff;
}

.small-box {
  border-radius: 1rem;
  overflow: hidden;
  background: rgba(255, 255, 255, 0.05);
  backdrop-filter: blur(10px);
  box-shadow: 0 10px 25px rgba(0,0,0,0.5);
  transition: all 0.4s ease;
}

.small-box:hover {
  transform: translateY(-6px) scale(1.02);
  box-shadow: 0 12px 30px rgba(0,0,0,0.7);
}

.small-box .icon {
  font-size: 2.8rem;
  opacity: 0.9;
}

.small-box-footer {
  background: rgba(255,255,255,0.07);
  display: block;
  padding: 0.6rem;
  text-align: center;
  color: #fff;
  font-weight: 500;
  transition: background 0.3s;
}

.small-box-footer:hover {
  background: rgba(255,255,255,0.15);
  text-decoration: none;
}

.progress {
  background-color: rgba(255,255,255,0.1);
  border-radius: 20px;
  overflow: hidden;
  height: 20px;
}

.progress-bar {
  transition: width 0.6s ease;
  font-weight: 600;
  font-size: 0.9rem;
}

canvas#starCanvas {
  position: fixed;
  top: 0;
  left: 0;
  z-index: -10;
  pointer-events: none;
}

@media (max-width: 768px) {
  #hero-header h1 {
    font-size: 1.8rem;
  }
}

</style>

<canvas id="starCanvas"></canvas>

<section class="content">
  <div class="container py-5">
    <!-- Hero Section -->
    <div id="hero-header">
      <h1 class="wow fadeInDown" data-wow-delay="0.2s">
        <i class="fas fa-graduation-cap text-warning me-2"></i>
        Selamat Datang di Media Pembelajaran</span>
      </h1>
      <p class="lead mt-3 wow fadeInUp" id="typewriter" data-wow-delay="0.6s"></p>
    </div>

    <!-- Dashboard Cards -->
    <div class="row mt-5 g-4">
      @php
        $cards = [
          ['title' => 'Materi', 'desc' => 'Belajar dengan animasi dan video', 'icon' => 'book', 'color' => 'primary', 'route' => route('siswa.materi.index'), 'text' => 'Jelajahi'],
          ['title' => 'Kuis', 'desc' => 'Soal Pilihan Ganda', 'icon' => 'question-circle', 'color' => 'success', 'route' => route('siswa.kuis.index'), 'text' => 'Kerjakan Kuis'],
          ['title' => 'Tugas', 'desc' => 'Upload file & gambar', 'icon' => 'tasks', 'color' => 'warning', 'route' => route('siswa.galeri.create'), 'text' => 'Lihat Tugas'],
        ];
      @endphp

      @foreach ($cards as $i => $card)
        <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="{{ 0.2 + $i * 0.2 }}s">
          <div class="small-box bg-{{ $card['color'] }} bg-gradient">
            <div class="p-4">
              <div class="d-flex justify-content-between align-items-center">
                <div>
                  <h3 class="fw-bold">{{ $card['title'] }}</h3>
                  <p>{{ $card['desc'] }}</p>
                </div>
                <div class="icon"><i class="fas fa-{{ $card['icon'] }} text-white"></i></div>
              </div>
              <a href="{{ $card['route'] }}" class="small-box-footer">{{ $card['text'] }} <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
        </div>
      @endforeach
    </div>

    <!-- Campaign Pembelajaran dengan Progress -->
<div class="row mt-5">
  <div class="col-12">
    <div class="bg-gradient bg-primary text-white p-5 rounded shadow wow fadeInUp" data-wow-delay="0.2s">
      <h2 class="fw-bold mb-4"><i class="fas fa-bullhorn me-2"></i>Campaign Pembelajaran</h2>
      <p class="lead">Ayo tingkatkan terus semangat belajar kamu! Berikut ini adalah perkembanganmu sejauh ini:</p>

      <div class="mb-4">
        <p class="mb-1 fw-bold">Materi Terpelajari: {{ $materiProgress ?? 0 }}%</p>
        <div class="progress" style="height: 20px;">
          <div class="progress-bar bg-success" role="progressbar" style="width: {{ $materiProgress ?? 0 }}%;" aria-valuenow="{{ $materiProgress ?? 0 }}" aria-valuemin="0" aria-valuemax="100">{{ $materiProgress ?? 0 }}%</div>
        </div>
      </div>

      <div class="mb-4">
        <p class="mb-1 fw-bold">Kuis Dikerjakan: {{ $kuisProgress ?? 0 }}%</p>
        <div class="progress" style="height: 20px;">
          <div class="progress-bar bg-warning" role="progressbar" style="width: {{ $kuisProgress ?? 0 }}%;" aria-valuenow="{{ $kuisProgress ?? 0 }}" aria-valuemin="0" aria-valuemax="100">{{ $kuisProgress ?? 0 }}%</div>
        </div>
      </div>

      <div class="mb-4">
        <p class="mb-1 fw-bold">Tugas Terkumpul: {{ $tugasProgress ?? 0 }}%</p>
        <div class="progress" style="height: 20px;">
          <div class="progress-bar bg-info" role="progressbar" style="width: {{ $tugasProgress ?? 0 }}%;" aria-valuenow="{{ $tugasProgress ?? 0 }}" aria-valuemin="0" aria-valuemax="100">{{ $tugasProgress ?? 0 }}%</div>
        </div>
      </div>
    </div>
  </div>
</div>


    <!-- Motivational Section -->
    <div class="row mt-5">
      <div class="col-12">
        <div class="position-relative p-5 text-white text-center rounded" style="background: url('/img/bg_parallax.jpg') center/cover no-repeat fixed;">
          <div class="position-relative bg-dark bg-opacity-50 p-4 rounded wow fadeInUp">
            <h2 class="fw-bold">Belajar dengan cara baru!</h2>
            <p class="lead">Gunakan materi interaktif, video, dan kuis untuk meningkatkan pemahamanmu.</p>
            <a href="{{ route('siswa.materi.index') }}" class="btn btn-outline-light mt-3">Mulai Belajar</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- JavaScript Effects -->
<script>
  document.addEventListener("DOMContentLoaded", () => {
    const canvas = document.getElementById('starCanvas');
    const ctx = canvas.getContext('2d');
    let stars = [];

    function resizeCanvas() {
      canvas.width = window.innerWidth;
      canvas.height = window.innerHeight;
    }

    function createStar() {
      return {
        x: Math.random() * canvas.width,
        y: Math.random() * canvas.height,
        r: Math.random() * 1.5,
        v: Math.random() * 1 + 0.3
      };
    }

    function drawStars() {
      ctx.clearRect(0, 0, canvas.width, canvas.height);
      ctx.fillStyle = '#fff';
      stars.forEach(s => {
        ctx.beginPath();
        ctx.arc(s.x, s.y, s.r, 0, 2 * Math.PI);
        ctx.fill();
      });
    }

    function updateStars() {
      stars.forEach(s => {
        s.y += s.v;
        if (s.y > canvas.height) {
          s.y = 0;
          s.x = Math.random() * canvas.width;
        }
      });
    }

    function animateStars() {
      drawStars();
      updateStars();
      requestAnimationFrame(animateStars);
    }

    resizeCanvas();
    window.addEventListener('resize', resizeCanvas);
    for (let i = 0; i < 100; i++) stars.push(createStar());
    animateStars();

    // Typewriter
    const textElement = document.getElementById("typewriter");
    const textToType = "Platform Interaktif untuk Siswa dan Guru SMKN 1 Linggo Sari Baganti!";
    let i = 0;

    function typeWriter() {
      if (i < textToType.length) {
        textElement.innerHTML += textToType.charAt(i);
        i++;
        setTimeout(typeWriter, 50);
      }
    }

    setTimeout(typeWriter, 1000);

    // GSAP Animations
    gsap.from("#hero-header h1", {
      opacity: 0,
      y: -50,
      duration: 1,
      ease: "power4.out"
    });

    gsap.from("#typewriter", {
      opacity: 0,
      y: 50,
      delay: 1,
      duration: 1,
      ease: "power4.out"
    });

    gsap.from(".small-box", {
      duration: 1,
      y: 60,
      opacity: 0,
      ease: "power4.out",
      stagger: 0.2,
      scrollTrigger: {
        trigger: ".small-box",
        start: "top 90%",
      }
      // Animate progress bars on scroll
document.querySelectorAll('.progress-bar').forEach(bar => {
  const value = bar.getAttribute('aria-valuenow');
  bar.style.width = '0%';
  const observer = new IntersectionObserver(entries => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        bar.style.width = `${value}%`;
      }
    });
  }, { threshold: 0.6 });
  observer.observe(bar);
});

    });
  });
</script>
@endsection
