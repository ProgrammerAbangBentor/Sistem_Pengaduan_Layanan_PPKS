<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Pengaduan</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table th, table td {
            border: 1px solid #000;
            padding: 8px;
            text-align: center;
        }

        table th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        .btn {
            display: inline-block;
            margin-bottom: 20px;
            padding: 10px 15px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            font-size: 14px;
            text-align: center;
            cursor: pointer;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        .btn-print {
            background-color: #28a745;
        }

        .btn-print:hover {
            background-color: #218838;
        }

        .badge {
            padding: 5px 10px;
            border-radius: 3px;
            color: #fff;
        }

        .badge-pending {
            background-color: #dc3545;
        }

        .badge-proses {
            background-color: #17a2b8;
        }

        .badge-selesai {
            background-color: #28a745;
        }

        .icon {
            margin-right: 8px;
        }
    </style>
</head>
<body>
    <div style="display: flex; justify-content: space-between; margin-bottom: 20px;">
        <a href="{{route('pengaduan.index')}}" class="btn">← Kembali</a>
        <button class="btn btn-print" onclick="window.print()">
            <i class="fas fa-print icon"></i> Print
        </button>
    </div>

    <h1>Daftar Pengaduan</h1>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Pekerjaan</th>
                <th>Kategori</th>
                <th>Tanggal</th>
                <th>Status</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pengaduans as $pengaduan)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $pengaduan->name }}</td>
                    <td>{{ $pengaduan->user_email ?? 'Tidak diketahui' }}</td>
                    <td>{{ $pengaduan->user }}</td>
                    <td>{{ $pengaduan->category_name }}</td>
                    <td>{{ $pengaduan->created_at->format('d-m-Y') }}</td>
                    <td>
                        <span class="badge badge-{{ $pengaduan->status }}">
                            {{ ucfirst($pengaduan->status) }}
                        </span>
                    </td>
                    <td>{{ $pengaduan->keterangan ?? 'Tidak ada keterangan' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
