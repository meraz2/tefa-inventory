<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Peminjam;
use App\Models\Peminjaman;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBarang = Barang::count();
        $totalPeminjam = Peminjam::count();

        // Menghitung data transaksi yang berstatus masih 'Dipinjam'
        $totalDipinjam = Peminjaman::where('status_peminjaman', 'Dipinjam')->count();

        // Mengambil log barang dengan stok minim (di bawah 5 unit)
        $stokMenipis = Barang::where('stok', '<', 5)->get();

        // TAMBAHAN: Mengambil 5 data log transaksi peminjaman terbaru untuk dashboard
        $peminjamans = Peminjaman::with(['peminjam', 'barang'])
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'totalBarang',
            'totalPeminjam',
            'totalDipinjam',
            'stokMenipis',
            'peminjamans' // Kirim variabel ke blade dashboard
        ));
    }
}
