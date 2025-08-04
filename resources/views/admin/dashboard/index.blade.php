@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-md-3"><div class="card text-white bg-primary mb-3"><div class="card-body"><h5 class="card-title">Jumlah Siswa</h5><p class="card-text">{{ $jumlahSiswa }}</p></div></div></div>
    <div class="col-md-3"><div class="card text-white bg-success mb-3"><div class="card-body"><h5 class="card-title">Jumlah Guru</h5><p class="card-text">{{ $jumlahGuru }}</p></div></div></div>
    <div class="col-md-3"><div class="card text-white bg-info mb-3"><div class="card-body"><h5 class="card-title">Jumlah Materi</h5><p class="card-text">{{ $jumlahMateri }}</p></div></div></div>
    <div class="col-md-3"><div class="card text-white bg-warning mb-3"><div class="card-body"><h5 class="card-title">Rata-rata Nilai</h5><p class="card-text">{{ number_format($rataRataNilai, 2) }}</p></div></div></div>
</div>
@endsection
