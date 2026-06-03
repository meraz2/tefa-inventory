<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Log Transaksi Sirkulasi TeFA</title>
    <style>
        body { font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; color: #333; font-size: 12px; line-height: 1.5; }
        .header { text-align: center; margin-bottom: 30px; border-bottom: 2px solid #333; padding-bottom: 10px; }
        .header h2 { margin: 0; uppercase tracking-wide; color: #111827; }
        .header p { margin: 5px 0 0 0; color: #6b7280; font-size: 13px; }
        table { w-full; border-collapse: collapse; margin-top: 10px; width: 100%; }
        th { background-color: #f9fafb; text-align: left; font-weight: bold; color: #4b5563; border: 1px solid #e5e7eb; padding: 10px; text-transform: uppercase; font-size: 10px; letter-spacing: 0.05em; }
        td { border: 1px solid #e5e7eb; padding: 10px; color: #374151; }
        tr:nth-child(even) { background-color: #fafafa; }
        .badge-dipinjam { color: #b45309; font-weight: bold; }
        .badge-kembali { color: #047857; font-weight: bold; }
    </style>
</head>
<body>

    <div class="header">
        <h2>LAPORAN LOG TRANSAKSI SIRKULASI BARANG</h2>
        <p>Teaching Factory (TeFA) Hub Inventory — Dicetak pada: {{ date('d M Y H:i') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Siswa Peminjam</th>
                <th>Kelas / Jurusan</th>
                <th>Item Barang</th>
                <th>Kuantitas</th>
                <th>Tgl Pinjam</th>
                <th>Tgl Kembali</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $index => $row)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td style="font-weight: bold;">{{ $row->peminjam->nama_peminjam }}</td>
                <td>{{ $row->peminjam->kelas }} — {{ $row->peminjam->jurusan }}</td>
                <td>{{ $row->barang->nama_barang }}</td>
                <td>{{ $row->jumlah_pinjam }} Pcs</td>
                <td>{{ \Carbon\Carbon::parse($row->tanggal_pinjam)->format('d M Y') }}</td>
                <td>{{ $row->tanggal_kembali ? \Carbon\Carbon::parse($row->tanggal_kembali)->format('d M Y') : '—' }}</td>
                <td>
                    <span class="{{ $row->status_peminjaman === 'Dipinjam' ? 'badge-dipinjam' : 'badge-kembali' }}">
                        {{ $row->status_peminjaman }}
                    </span>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <script>
        // Memicu jendela cetak/save PDF bawaan browser secara otomatis saat halaman dibuka
        window.onload = function() { window.print(); }
    </script>
</body>
</html>
