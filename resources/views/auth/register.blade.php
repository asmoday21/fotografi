@extends('layouts.app')

@section('title', 'Register')

@section('content')
<!-- Google Font & Icon -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

<style>
    body {
        margin: 0;
        padding: 0;
        background: linear-gradient(to right, #1e3c72, #2a5298);
        font-family: 'Poppins', sans-serif;
        min-height: 100vh;
        overflow: hidden;
        color: #fff;
        position: relative;
    }

    canvas#bg-particles {
        position: fixed;
        top: 0;
        left: 0;
        z-index: 0;
        width: 100vw;
        height: 100vh;
    }

    .register-container {
        position: relative;
        z-index: 1;
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        padding: 30px;
        animation: fadeInUp 1s ease;
    }

    .card {
        width: 100%;
        max-width: 500px;
        padding: 30px;
        border-radius: 1.2rem;
        background: rgba(255, 255, 255, 0.05);
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.4);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.15);
        animation: zoomFade 1s ease;
    }

    @keyframes zoomFade {
        0% { transform: scale(0.9); opacity: 0; }
        100% { transform: scale(1); opacity: 1; }
    }

    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(40px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .form-label {
        color: #e0e0e0;
        font-weight: 500;
    }

    .form-control, .form-select {
        border-radius: 10px;
        background: rgba(255, 255, 255, 0.07);
        border: none;
        color: #fff;
    }

    .form-control::placeholder {
        color: #ccc;
    }

    .form-control:focus {
        background: rgba(255, 255, 255, 0.15);
        outline: none;
        color: #fff;
    }

    .btn-primary {
        border-radius: 10px;
        background: linear-gradient(135deg, #667eea, #764ba2);
        border: none;
        font-weight: 600;
        transition: 0.3s ease-in-out;
    }

    .btn-primary:hover {
        background: linear-gradient(135deg, #5b69d6, #633f9f);
        transform: scale(1.03);
    }

    .text-link {
        color: #cfd8ff;
        text-decoration: none;
    }

    .text-link:hover {
        color: #ffffff;
    }

    .text-center h3 {
        font-weight: 700;
        color: #fff;
        margin-bottom: 25px;
    }

    @media (max-width: 768px) {
        .card {
            padding: 20px;
        }
    }
    .blur-nav {
    background: rgba(255, 255, 255, 0.05);
    backdrop-filter: blur(10px);
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    transition: all 0.4s ease-in-out;
}

.navbar-brand {
    font-size: 1.4rem;
    letter-spacing: 1px;
    color: #fff !important;
}

.navbar-nav .nav-link {
    font-weight: 500;
    transition: 0.3s ease;
}

.navbar-nav .nav-link:hover {
    color: #c0d4ff !important;
}

</style>

<canvas id="bg-particles"></canvas>
<nav class="navbar navbar-expand-lg navbar-dark bg-transparent fixed-top blur-nav">
    <div class="container">
        <a class="navbar-brand fw-bold text-white" href="{{ url('/') }}">
            <i class="bi bi-lightning-fill"></i> WebKu
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav gap-3">
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ url('media-fotografi/resouces/views/welcome.blade.php') }}">
                        <i class="bi bi-house-door-fill"></i> Beranda
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('login') }}">
                        <i class="bi bi-box-arrow-in-right"></i> Login
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="register-container">
    <div class="card">
        <div class="card-body">
            <h3 class="text-center">Register</h3>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input id="name" type="text" name="name" class="form-control @error('name') is-invalid @enderror" required autofocus value="{{ old('name') }}">
                    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input id="email" type="email" name="email" class="form-control @error('email') is-invalid @enderror" required value="{{ old('email') }}">
                    @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input id="password" type="password" name="password" class="form-control @error('password') is-invalid @enderror" required>
                    @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" class="form-control" required>
                </div>

                <div class="mb-4">
                    <label for="role" class="form-label">Daftar Sebagai</label>
                    <select name="role" id="role" class="form-select @error('role') is-invalid @enderror" required>
                        <option value="" disabled selected>-- Pilih Role --</option>
                        <option value="Admin" {{ old('role') == 'Admin' ? 'selected' : '' }}>Admin</option>
                        <option value="Guru" {{ old('role') == 'Guru' ? 'selected' : '' }}>Guru</option>
                        <option value="Siswa" {{ old('role') == 'Siswa' ? 'selected' : '' }}>Siswa</option>
                    </select>
                    @error('role') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-primary btn-lg">Register</button>
                </div>

                <div class="mt-3 text-center">
                    <a href="{{ route('login') }}" class="text-link">Sudah punya akun? Login disini</a>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- ✨ JavaScript Partikel -->
<script>
    const canvas = document.getElementById("bg-particles");
    const ctx = canvas.getContext("2d");

    let particles = [];
    const colors = ["#ffffff", "#b3c0ff", "#a5e9ff", "#c6bfff"];

    function resizeCanvas() {
        canvas.width = window.innerWidth;
        canvas.height = window.innerHeight;
    }

    function createParticles() {
        particles = [];
        for (let i = 0; i < 80; i++) {
            particles.push({
                x: Math.random() * canvas.width,
                y: Math.random() * canvas.height,
                radius: Math.random() * 2 + 1,
                speedX: Math.random() * 0.6 - 0.3,
                speedY: Math.random() * 0.6 - 0.3,
                color: colors[Math.floor(Math.random() * colors.length)]
            });
        }
    }

    function animateParticles() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        for (let p of particles) {
            ctx.beginPath();
            ctx.arc(p.x, p.y, p.radius, 0, Math.PI * 2);
            ctx.fillStyle = p.color;
            ctx.fill();

            p.x += p.speedX;
            p.y += p.speedY;

            if (p.x < 0 || p.x > canvas.width || p.y < 0 || p.y > canvas.height) {
                p.x = Math.random() * canvas.width;
                p.y = Math.random() * canvas.height;
            }
        }
        requestAnimationFrame(animateParticles);
    }

    window.addEventListener("resize", () => {
        resizeCanvas();
        createParticles();
    });

    resizeCanvas();
    createParticles();
    animateParticles();
</script>
@endsection
