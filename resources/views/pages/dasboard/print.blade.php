<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Data Pengaduan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        h1, h2 {
            text-align: center;
        }
        .filter-section {
            margin-bottom: 20px;
        }
        .filter-section label {
            margin-right: 10px;
        }

        .print-btn {
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
            font-size: 16px;
            margin: 20px 0;
        }
        .print-btn:hover {
            background-color: #0056b3;
        }

        /* Menyembunyikan tombol print saat halaman dicetak */
        @media print {
            .print-btn {
                display: none;
            }
        }
    </style>
</head>
<body>
    <button class="print-btn" onclick="window.print()">Print Halaman</button>
    <h1>Data Pengaduan</h1>
    <h2>Laporan Pengaduan</h2>

    <!-- Filter -->
    <div class="filter-section">
        <strong>Filter:</strong>
        <p>Kategori:
            {{ $categories->firstWhere('id', request()->kategori_pengaduan_id)->name ?? 'Semua Kategori' }}
        </p>
        <p>Cari Nama/Laporan: "{{ request()->name ?? 'Semua' }}"</p>
    </div>

    <!-- Tabel Data Pengaduan -->
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Pengadu</th>
                <th>Email</th>
                <th>Kategori</th>
                <th>Laporan</th>
                <th>Status</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($pengaduans as $index => $pengaduan)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $pengaduan->user }}</td>
                    <td>{{ $pengaduan->user_email }}</td>
                    <td>{{ $pengaduan->category_name }}</td>
                    <td>{{ $pengaduan->laporan }}</td>
                    <td>
                        @if ($pengaduan->status == 'pending')
                            Menunggu
                        @elseif ($pengaduan->status == 'proses')
                            Sedang Diproses
                        @elseif ($pengaduan->status == 'selesai')
                            Selesai
                        @else
                            Tidak Diketahui
                        @endif
                    </td>
                    <td>{{ $pengaduan->created_at->format('d-m-Y H:i') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" style="text-align: center;">Tidak ada data pengaduan ditemukan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

</body>
</html>
