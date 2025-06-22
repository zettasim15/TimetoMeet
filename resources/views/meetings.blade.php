<!DOCTYPE html>
<html>
<head>
    <title>Daftar Rapat</title>
</head>
<body>
    <h2>Daftar Rapat</h2>
    @foreach ($meetings as $meeting)
        <p>{{ $meeting->judul }} - {{ $meeting->tanggal }} - {{ $meeting->lokasi }}</p>
    @endforeach
</body>
</html>
