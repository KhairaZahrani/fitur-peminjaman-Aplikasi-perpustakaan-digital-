
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Peminjaman</title>
    <style>
        @media print {
            .no-print { display: none; }
        }
    </style>
</head>
<body>
    <h1 align="center">Laporan Peminjaman</h1>
    <table border="1" cellpadding="5" cellspacing="0" style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr>
                <th>ID Peminjaman</th>
                <th>Nama Pengguna</th>
                <th>Judul Buku</th>
                <th>Tanggal Peminjaman</th>
                <th>Tanggal Pengembalian</th>
                <th>Status Peminjaman</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($peminjaman as $item)
                <tr>
                    <td>{{ $item->id_peminjaman }}</td>
                    <td>{{ $item->user->username }}</td>
                    <td>{{ $item->buku->judul }}</td>
                    <td>{{ $item->tanggal_peminjaman }}</td>
                    <td>{{ $item->tanggal_pengembalian }}</td>
                    <td>{{ $item->status_peminjaman }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="no-print">
        <a href="javascript:window.print()" class="btn btn-primary">Cetak</a>
        <a href="/" class="btn btn-primary">>> kembali</a>
    </div>
</body>
</html>