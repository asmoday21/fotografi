@extends('siswa.layouts.app')

@section('content')
<div class="container py-5">
    <h4 class="text-2xl font-bold mb-4">📊 Statistik Kuis</h4>

    <div class="card p-4 shadow rounded-xl">
        <canvas id="chartSkor"></canvas>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const ctx = document.getElementById('chartSkor').getContext('2d');
const chart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: {!! json_encode(array_column($data, 'judul')) !!},
        datasets: [{
            label: 'Skor Rata-rata',
            data: {!! json_encode(array_column($data, 'rata2')) !!},
            backgroundColor: 'rgba(54, 162, 235, 0.7)',
            borderRadius: 10
        }]
    },
    options: {
        responsive: true,
        scales: {
            y: { beginAtZero: true, max: 100 }
        }
    }
});
</script>
@endsection
