@extends('layouts.app')

@section('title', 'Reset Password')

@section('content')
<style>
    body {
        background: linear-gradient(135deg, #667eea, #764ba2);
        min-height: 100vh;
        font-family: 'Poppins', sans-serif;
    }
    .card {
        border-radius: 1rem;
        box-shadow: 0 0.5rem 1.5rem rgba(118, 75, 162, 0.3);
        border: none;
    }
    .form-control {
        border-radius: 0.75rem;
    }
    .btn-primary {
        border-radius: 0.75rem;
        background-color: #764ba2;
        border: none;
        transition: background-color 0.3s ease;
    }
    .btn-primary:hover {
        background-color: #5a3577;
    }
</style>

<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="col-md-5">
        <div class="card p-4">
            <div class="card-body">
                <h3 class="text-center mb-4 text-white">Reset Password</h3>

                <form method="POST" action="{{ route('password.store') }}">
                    @csrf

                    <input type="hidden" name="token" value="{{ $request->route('token') }}">

                    {{-- Email --}}
                    <div class="mb-3">
                        <label for="email" class="form-label text-white">Email</label>
                        <input id="email" type="email" name="email" value="{{ old('email', $request->email) }}" required autofocus autocomplete="username" class="form-control @error('email') is-invalid @enderror">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Password --}}
                    <div class="mb-3">
                        <label for="password" class="form-label text-white">Password Baru</label>
                        <input id="password" type="password" name="password" required autocomplete="new-password" class="form-control @error('password') is-invalid @enderror">
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Confirm Password --}}
                    <div class="mb-4">
                        <label for="password_confirmation" class="form-label text-white">Konfirmasi Password</label>
                        <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" class="form-control @error('password_confirmation') is-invalid @enderror">
                        @error('password_confirmation')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary btn-lg">Reset Password</button>
                    </div>
                </form>

                <div class="mt-3 text-center">
                    <a href="{{ route('login') }}" class="text-white text-decoration-underline">Kembali ke Login</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
