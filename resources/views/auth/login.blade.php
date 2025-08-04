<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - SMKN 1 LSB</title>

    <!-- Fonts & Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        * {
            margin: 0; padding: 0; box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            color: #fff;
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* Background Video */
        .video-bg {
            position: fixed;
            top: 0; left: 0;
            width: 100vw; height: 100vh;
            object-fit: cover;
            z-index: -2;
        }

        .overlay {
            position: fixed;
            top: 0; left: 0;
            width: 100vw; height: 100vh;
            background: rgba(0, 0, 0, 0.55);
            z-index: -1;
        }

        .login-container {
            max-width: 450px;
            margin: 6% auto;
            background: rgba(255, 255, 255, 0.07);
            backdrop-filter: blur(18px);
            border-radius: 20px;
            padding: 50px 35px;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.4);
            animation: fadeIn 1.2s ease;
        }

        @keyframes fadeIn {
            from { transform: translateY(20px); opacity: 0; }
            to   { transform: translateY(0); opacity: 1; }
        }

        h3 {
            text-align: center;
            font-weight: 700;
            margin-bottom: 25px;
        }

        .input-group {
            position: relative;
            margin-bottom: 20px;
        }

        .input-group i {
            position: absolute;
            top: 50%;
            left: 15px;
            transform: translateY(-50%);
            color: #aaa;
        }

        .form-control {
            padding-left: 42px;
            background: rgba(255, 255, 255, 0.12);
            border: none;
            border-radius: 14px;
            color: white;
        }

        .form-control::placeholder {
            color: #ccc;
        }

        .form-control:focus {
            background: rgba(255, 255, 255, 0.18);
            box-shadow: 0 0 0 2px rgba(0, 255, 255, 0.3);
        }

        .btn-login {
            background: linear-gradient(135deg, #00c6ff, #0072ff);
            border: none;
            border-radius: 14px;
            padding: 12px;
            color: white;
            font-weight: bold;
            width: 100%;
            transition: all 0.3s ease-in-out;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            background: linear-gradient(135deg, #0072ff, #00c6ff);
        }

        .text-link {
            color: #ccc;
            text-align: center;
            display: block;
            margin-top: 15px;
        }

        .text-link a {
            color: #aaf;
            text-decoration: none;
        }

        .text-link a:hover {
            color: #fff;
        }

        .form-check-label {
            color: #ddd;
        }

        @media (max-width: 576px) {
            .login-container {
                margin: 10% 5%;
                padding: 40px 25px;
            }
        }
        .glass-header {
    background: rgba(255, 255, 255, 0.05);
    backdrop-filter: blur(12px);
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    z-index: 1000;
    transition: all 0.3s ease-in-out;
}
.glass-header .navbar-brand {
    color: #fff !important;
    font-size: 1rem;
    letter-spacing: 0.5px;
}
.glass-header .navbar-brand:hover {
    color: #aadfff !important;
}

    </style>
</head>
<body>
<!-- Header Transparan -->
<nav class="navbar navbar-expand-lg navbar-dark bg-transparent fixed-top glass-header shadow-sm px-4">
    <div class="container-fluid">
        <a href="{{ url('/') }}" class="navbar-brand d-flex align-items-center gap-2">
            <i class="bi bi-arrow-left-circle-fill fs-4"></i>
            <span class="fw-bold">Kembali ke Beranda</span>
        </a>
    </div>
</nav>

    <!-- Background Video -->
    <video autoplay muted loop class="video-bg">
        <source src="{{ asset('assets/img/login.mp4') }}" type="video/mp4">
        Your browser does not support the video tag.
    </video>

    <!-- Overlay gelap -->
    <div class="overlay"></div>

    <!-- Login Box -->
    <div class="login-container">
        <h3><i class="bi bi-person-circle me-2"></i>Login Admin</h3>

        @if (session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="input-group">
                <i class="bi bi-envelope-fill"></i>
                <input type="email" name="email" class="form-control" placeholder="Email" required value="{{ old('email') }}">
                @error('email') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="input-group">
                <i class="bi bi-lock-fill"></i>
                <input type="password" name="password" class="form-control" placeholder="Password" required>
                @error('password') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="form-check mb-3">
                <input type="checkbox" class="form-check-input" name="remember" id="remember_me">
                <label class="form-check-label" for="remember_me">Ingat saya</label>
            </div>

            <button type="submit" class="btn btn-login">Masuk</button>

            <div class="text-link">
                Belum punya akun? <a href="{{ route('register') }}">Daftar disini</a>
            </div>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
