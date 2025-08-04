<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <table>
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Siswa</th>
            <th>Kuis</th>
            <th>Nilai</th>
            <th>Waktu</th>
        </tr>
    </thead>
    <tbody>
        @foreach($hasilKuis as $index => $hasil)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $hasil->user->name ?? '-' }}</td>
            <td>{{ $hasil->kuis->judul ?? '-' }}</td>
            <td>{{ $hasil->nilai }}</td>
            <td>{{ $hasil->created_at->format('d-m-Y H:i') }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>