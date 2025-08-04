@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Forum Diskusi Siswa & Guru</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('diskusi.store') }}" method="POST">
        @csrf
        <textarea name="pesan" class="form-control mb-2" rows="3" placeholder="Tulis komentar..." required></textarea>
        <button type="submit" class="btn btn-primary">Kirim</button>
    </form>

    <hr>

    @foreach($diskusi as $d)
        <div class="border p-3 rounded mb-3">
            <strong>{{ $d->pengirim->name }} ({{ $d->role }})</strong>
            <small class="text-muted float-end">{{ $d->created_at->diffForHumans() }}</small>
            <p>{{ $d->pesan }}</p>
        </div>
    @endforeach
</div>
@endsection
