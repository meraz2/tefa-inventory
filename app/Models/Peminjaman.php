<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Peminjaman extends Model
{
    // KETENTUAN: Menentukan nama tabel secara eksplisit karena bukan bentuk jamak bahasa Inggris (plural)
    protected $table = 'peminjaman';

    // Menentukan field mana saja yang boleh diisi secara massal (Mass Assignment)
    protected $fillable = [
        'peminjam_id',
        'barang_id',
        'tanggal_pinjam',
        'tanggal_kembali',
        'jumlah_pinjam',
        'status_peminjaman'
    ];

    /**
     * RELASI DATABASE: Setiap peminjaman harus terhubung dengan data peminjam.
     * (Hubungan Banyak ke Satu / BelongsTo)
     */
    public function peminjam(): BelongsTo
    {
        return $this->belongsTo(Peminjam::class, 'peminjam_id');
    }

    /**
     * RELASI DATABASE: Setiap peminjaman harus terhubung dengan data barang.
     * (Hubungan Banyak ke Satu / BelongsTo)
     */
    public function barang(): BelongsTo
    {
        return $this->belongsTo(Barang::class, 'barang_id');
    }
}
