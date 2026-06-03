<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Barang;
use App\Models\Peminjam;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PeminjamanController extends Controller
{
    /**
     * Tampilkan daftar log transaksi dengan filter pencarian
     */
    public function index(Request $request)
    {
        // Query dasar dengan Eager Loading agar query efisien
        $query = Peminjaman::with(['peminjam', 'barang']);

        // Handler Filter Pencarian (Nama Siswa atau Nama Barang)
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->whereHas('peminjam', function($p) use ($search) {
                    $p->where('nama_peminjam', 'like', '%' . $search . '%');
                })->orWhereHas('barang', function($b) use ($search) {
                    $b->where('nama_barang', 'like', '%' . $search . '%');
                });
            });
        }

        // Handler Filter Status Peminjaman
        if ($request->has('status') && $request->status != '') {
            $query->where('status_peminjaman', $request->status);
        }

        // Urutkan berdasarkan data terbaru
        $peminjamans = $query->latest()->paginate(10)->withQueryString();

        // Memanggil folder resources/views/peminjaman/index.blade.php
        return view('peminjaman.index', compact('peminjamans'));
    }

    /**
     * Tampilkan form untuk membuat peminjaman baru
     */
    public function create()
    {
        $barangs = Barang::where('stok', '>', 0)->get();
        $peminjams = Peminjam::all();
        return view('peminjaman.create', compact('barangs', 'peminjams'));
    }

    /**
     * Simpan data peminjaman baru ke database
     */
    public function store(Request $request)
    {
        // PERBAIKAN: Mengubah 'barangs,id' menjadi 'barang,id' agar sesuai nama tabel database Anda
        $request->validate([
            'peminjam_id' => 'required|exists:peminjam,id',
            'barang_id' => 'required|exists:barang,id',
            'jumlah_pinjam' => 'required|integer|min:1',
            'tanggal_pinjam' => 'required|date',
        ]);

        $barang = Barang::findOrFail($request->barang_id);

        if ($barang->stok < $request->jumlah_pinjam) {
            return redirect()->back()->withErrors(['jumlah_pinjam' => 'Stok barang tidak mencukupi.'])->withInput();
        }

        // Simpan transaksi peminjaman
        Peminjaman::create([
            'peminjam_id' => $request->peminjam_id,
            'barang_id' => $request->barang_id,
            'jumlah_pinjam' => $request->jumlah_pinjam,
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'status_peminjaman' => 'Dipinjam', // Sesuai opsi ENUM di database
        ]);

        // Kurangi stok barang
        $barang->decrement('stok', $request->jumlah_pinjam);

        return redirect()->route('peminjaman.index')->with('success', 'Data peminjaman berhasil disimpan.');
    }

    /**
     * Tampilkan form edit peminjaman (jika diperlukan)
     */
    public function edit(Peminjaman $peminjaman)
    {
        $barangs = Barang::all();
        $peminjams = Peminjam::all();
        return view('peminjaman.edit', compact('peminjaman', 'barangs', 'peminjams'));
    }

    /**
     * Update data peminjaman / Proses Pengembalian Barang
     */
    public function update(Request $request, Peminjaman $peminjaman)
    {
        // Logika jika update digunakan untuk pengembalian barang
        if ($request->has('proses_kembali')) {
            // Mengubah nilai status menjadi 'Dikembalikan' agar sinkron dengan ENUM database Anda
            $peminjaman->update([
                'tanggal_kembali' => now(),
                'status_peminjaman' => 'Dikembalikan',
            ]);

            // Kembalikan stok barang
            Barang::where('id', $peminjaman->barang_id)->increment('stok', $peminjaman->jumlah_pinjam);

            return redirect()->route('peminjaman.index')->with('success', 'Barang berhasil dikembalikan.');
        }

        return redirect()->route('peminjaman.index');
    }

    /**
     * Hapus log peminjaman
     */
    public function destroy(Peminjaman $peminjaman)
    {
        $peminjaman->delete();
        return redirect()->route('peminjaman.index')->with('success', 'Log peminjaman berhasil dihapus.');
    }

    /**
     * FITUR EXPORT EXCEL (Native Clean HTML Table Method)
     */
    public function exportExcel(Request $request)
    {
        $query = Peminjaman::with(['peminjam', 'barang']);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->whereHas('peminjam', function($p) use ($search) {
                    $p->where('nama_peminjam', 'like', '%' . $search . '%');
                })->orWhereHas('barang', function($b) use ($search) {
                    $b->where('nama_barang', 'like', '%' . $search . '%');
                });
            });
        }

        if ($request->filled('status')) {
            $query->where('status_peminjaman', $request->status);
        }

        $data = $query->latest()->get();

        $filename = "Log_Transaksi_TeFA_" . date('Ymd_His') . ".xls";

        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=\"$filename\"");
        header("Pragma: no-cache");
        header("Expires: 0");

        echo '<table border="1">';
        echo '<tr>
                <th style="background-color: #f3f4f6; font-weight: bold;">Nama Peminjam</th>
                <th style="background-color: #f3f4f6; font-weight: bold;">Kelas/Jurusan</th>
                <th style="background-color: #f3f4f6; font-weight: bold;">Item Barang</th>
                <th style="background-color: #f3f4f6; font-weight: bold;">Jumlah</th>
                <th style="background-color: #f3f4f6; font-weight: bold;">Tanggal Pinjam</th>
                <th style="background-color: #f3f4f6; font-weight: bold;">Tanggal Kembali</th>
                <th style="background-color: #f3f4f6; font-weight: bold;">Status</th>
              </tr>';

        foreach ($data as $row) {
            $tgl_kembali = $row->tanggal_kembali ? date('d M Y', strtotime($row->tanggal_kembali)) : '—';
            echo "<tr>
                    <td>{$row->peminjam->nama_peminjam}</td>
                    <td>{$row->peminjam->kelas} - {$row->peminjam->jurusan}</td>
                    <td>{$row->barang->nama_barang}</td>
                    <td>{$row->jumlah_pinjam} Pcs</td>
                    <td>" . date('d M Y', strtotime($row->tanggal_pinjam)) . "</td>
                    <td>{$tgl_kembali}</td>
                    <td>{$row->status_peminjaman}</td>
                  </tr>";
        }
        echo '</table>';
        exit;
    }

    /**
     * FITUR EXPORT PDF (Menggunakan Stream/Print HTML standard layout)
     */
    public function exportPdf(Request $request)
    {
        $query = Peminjaman::with(['peminjam', 'barang']);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->whereHas('peminjam', function($p) use ($search) {
                    $p->where('nama_peminjam', 'like', '%' . $search . '%');
                })->orWhereHas('barang', function($b) use ($search) {
                    $b->where('nama_barang', 'like', '%' . $search . '%');
                });
            });
        }

        if ($request->filled('status')) {
            $query->where('status_peminjaman', $request->status);
        }

        $data = $query->latest()->get();

        // Mengarah ke file resources/views/peminjaman/pdf.blade.php
        return view('peminjaman.pdf', compact('data'));
    }
}
