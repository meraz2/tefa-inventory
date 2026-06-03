<x-app-layout>
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Ringkasan Sistem</h1>
        <p class="text-sm text-slate-500 mt-1">Status ketersediaan logistik dan peminjaman alat hari ini.</p>
    </div>

    @if($stokMenipis->count() > 0)
        <div class="mb-8 bg-gradient-to-br from-rose-50 to-orange-50 border border-rose-100 rounded-2xl p-5 shadow-sm flex items-start space-x-4">
            <div class="p-3 bg-rose-500 text-white rounded-xl shadow-md shadow-rose-500/20 font-bold">⚠️</div>
            <div class="flex-1">
                <h4 class="text-sm font-bold text-rose-900">Perhatian: Stok Logistik Menipis!</h4>
                <p class="text-xs text-rose-700/80 mt-0.5">Segera lakukan restock atau pengecekan unit pada item berikut:</p>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-3 mt-3">
                    @foreach($stokMenipis as $b)
                        <div class="bg-white/80 backdrop-blur-sm p-3 rounded-xl border border-rose-100 flex items-center justify-between shadow-xs">
                            <span class="text-xs font-semibold text-slate-800">{{ $b->nama_barang }}</span>
                            <span class="text-xs font-bold bg-rose-100 text-rose-600 px-2 py-0.5 rounded-lg">Sisa: {{ $b->stok }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-[0_10px_30px_rgba(0,0,0,0.01)] relative overflow-hidden group">
            <div class="absolute right-0 top-0 w-24 h-24 bg-orange-500/5 rounded-full translate-x-6 -translate-y-6 group-hover:scale-125 transition duration-500"></div>
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Total Unit Barang</p>
                    <h3 class="text-3xl font-extrabold text-slate-900 mt-2 tracking-tight">{{ $totalBarang }}</h3>
                </div>
                <div class="w-12 h-12 bg-orange-50 rounded-xl flex items-center justify-center text-orange-500 font-bold">Box</div>
            </div>
            <div class="mt-4 pt-4 border-t border-slate-50 flex items-center text-xs text-slate-500">
                <span class="text-emerald-500 font-bold mr-1">Tersedia</span> untuk dipinjam praktek siswa.
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-[0_10px_30px_rgba(0,0,0,0.01)] relative overflow-hidden group">
            <div class="absolute right-0 top-0 w-24 h-24 bg-amber-500/5 rounded-full translate-x-6 -translate-y-6 group-hover:scale-125 transition duration-500"></div>
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Peminjam Terdaftar</p>
                    <h3 class="text-3xl font-extrabold text-slate-900 mt-2 tracking-tight">{{ $totalPeminjam }}</h3>
                </div>
                <div class="w-12 h-12 bg-amber-50 rounded-xl flex items-center justify-center text-amber-500 font-bold">User</div>
            </div>
            <div class="mt-4 pt-4 border-t border-slate-50 flex items-center text-xs text-slate-500">
                Data sinkron via <span class="font-bold text-orange-500 mx-1">Database Seeder</span> sekolah.
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-[0_10px_30px_rgba(0,0,0,0.01)] relative overflow-hidden group">
            <div class="absolute right-0 top-0 w-24 h-24 bg-slate-900/5 rounded-full translate-x-6 -translate-y-6 group-hover:scale-125 transition duration-500"></div>
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Sedang Dipinjam</p>
                    <h3 class="text-3xl font-extrabold text-slate-900 mt-2 tracking-tight">{{ $totalDipinjam }}</h3>
                </div>
                <div class="w-12 h-12 bg-slate-900 text-white rounded-xl flex items-center justify-center font-bold">Out</div>
            </div>
            <div class="mt-4 pt-4 border-t border-slate-50 flex items-center text-xs text-slate-500">
                Memerlukan monitoring pemulangan barang.
            </div>
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
        <div class="p-5 border-b border-slate-50 flex items-center justify-between">
            <div>
                <h3 class="text-sm font-bold text-slate-900">Sirkulasi Transaksi Terkini</h3>
                <p class="text-xs text-slate-400 mt-0.5">Menampilkan 5 aktivitas peminjaman logistik TeFA paling baru.</p>
            </div>
            <a href="{{ route('peminjaman.index') }}" class="text-xs font-bold text-orange-500 hover:text-orange-600 transition">Lihat Seluruh Log →</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50/70 border-b border-slate-100 text-[11px] font-bold text-slate-400 uppercase tracking-widest">
                        <th class="p-4 pl-6">Siswa Peminjam</th>
                        <th class="p-4">Item Komoditas</th>
                        <th class="p-4 text-center">Kuantitas</th>
                        <th class="p-4">Waktu Pinjam</th>
                        <th class="p-4">Waktu Kembali</th>
                        <th class="p-4">Status Sirkulasi</th>
                        <th class="p-4 text-center pr-6">Manajemen Rute</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-sm text-slate-600">
                    @forelse($peminjamans as $pinjam)
                    <tr class="hover:bg-slate-50/50 transition">
                        <td class="p-4 pl-6">
                            <span class="font-bold text-slate-900 block text-sm">{{ $pinjam->peminjam->nama_peminjam }}</span>
                            <span class="text-xs text-slate-400 font-medium">{{ $pinjam->peminjam->kelas }} — {{ $pinjam->peminjam->jurusan }}</span>
                        </td>
                        <td class="p-4 font-semibold text-slate-700">
                            {{ $pinjam->barang->nama_barang }}
                        </td>
                        <td class="p-4 text-center font-extrabold text-slate-900">
                            {{ $pinjam->jumlah_pinjam }} <span class="text-[10px] text-slate-400 font-medium">Pcs</span>
                        </td>
                        <td class="p-4 text-slate-500 font-medium text-xs">
                            {{ \Carbon\Carbon::parse($pinjam->tanggal_pinjam)->format('d M Y') }}
                        </td>
                        <td class="p-4 text-slate-500 font-medium text-xs">
                            {{ $pinjam->tanggal_kembali ? \Carbon\Carbon::parse($pinjam->tanggal_kembali)->format('d M Y') : '—' }}
                        </td>
                        <td class="p-4">
                            @if($pinjam->status_peminjaman === 'Dipinjam')
                                <span class="inline-flex items-center px-2.5 py-1 text-xs font-bold rounded-full bg-orange-500/10 text-orange-600 border border-orange-500/10">
                                    <span class="w-1.5 h-1.5 rounded-full bg-orange-500 mr-1.5 animate-pulse"></span>
                                    {{ $pinjam->status_peminjaman }}
                                </span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-1 text-xs font-bold rounded-full bg-emerald-50 text-emerald-600 border border-emerald-100">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 mr-1.5"></span>
                                    {{ $pinjam->status_peminjaman }}
                                </span>
                            @endif
                        </td>
                        <td class="p-4 text-center pr-6">
                            <div class="flex items-center justify-center space-x-2">
                                @if($pinjam->status_peminjaman === 'Dipinjam')
                                <form action="{{ route('peminjaman.update', $pinjam->id) }}" method="POST" onsubmit="return confirm('Nyatakan unit barang logistik telah kembali penuh?')">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="proses_kembali" value="1">
                                    <button type="submit" class="px-3 py-1.5 bg-orange-500 text-white rounded-lg text-xs font-bold hover:bg-orange-600 transition duration-150 shadow-xs">
                                        Pulangkan
                                    </button>
                                </form>
                                @else
                                    <span class="text-xs text-slate-400 font-bold bg-slate-50 px-2 py-1 rounded-md">Archived</span>
                                @endif

                                <form action="{{ route('peminjaman.destroy', $pinjam->id) }}" method="POST" onsubmit="return confirm('Hapus permanen log riwayat peminjaman?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-1.5 text-slate-400 hover:text-red-500 rounded-lg transition">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="p-12 text-center text-slate-400 font-medium">Arsip log sirkulasi peminjaman kosong atau tidak ditemukan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
