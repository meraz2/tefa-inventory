<x-app-layout>
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-8 gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Log Transaksi</h1>
            <p class="text-sm text-slate-500 mt-1">Rekam jejak sirkulasi peminjaman barang TeFA terintegrasi.</p>
        </div>
        <a href="{{ route('peminjaman.create') }}" class="inline-flex items-center justify-center px-5 py-2.5 bg-slate-900 text-white font-bold text-sm rounded-xl hover:bg-slate-800 transition shadow-sm">
            + Registrasi Peminjaman
        </a>
    </div>

    <div class="bg-white border border-slate-100 rounded-2xl p-4 mb-6 shadow-[0_10px_30px_rgba(0,0,0,0.01)] flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <form action="" method="GET" class="flex flex-wrap items-center gap-3 flex-1">
            <div class="relative min-w-[200px] flex-1 sm:flex-none">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama siswa / barang..." class="w-full px-4 py-2 text-xs bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:border-orange-500 focus:bg-white focus:ring-4 focus:ring-orange-500/10 transition duration-150">
            </div>

            <select name="status" class="px-3 py-2 text-xs bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:border-orange-500 text-slate-600 font-medium cursor-pointer">
                <option value="">Semua Status</option>
                <option value="Dipinjam" {{ request('status') === 'Dipinjam' ? 'selected' : '' }}>Dipinjam</option>
                <option value="Dikembalikan" {{ request('status') === 'Dikembalikan' ? 'selected' : '' }}>Dikembalikan</option>
            </select>

            <button type="submit" class="px-4 py-2 bg-orange-500 text-white font-bold text-xs rounded-xl hover:bg-orange-600 transition shadow-sm shadow-orange-500/10">
                Terapkan
            </button>

            @if(request('search') || request('status'))
                <a href="{{ url()->current() }}" class="text-xs font-semibold text-slate-400 hover:text-slate-600 transition underline decoration-2 underline-offset-4">
                    Reset Filter
                </a>
            @endif
        </form>

        <div class="flex items-center gap-2 border-t md:border-t-0 pt-3 md:pt-0 border-slate-100">
            <a href="{{ route('peminjaman.export.excel', request()->query()) }}" class="flex items-center justify-center space-x-1.5 px-3.5 py-2 border border-emerald-200 bg-emerald-50/50 hover:bg-emerald-50 text-emerald-700 font-bold text-xs rounded-xl transition">
                <span>📊</span>
                <span>Export Excel</span>
            </a>
            <a href="{{ route('peminjaman.export.pdf', request()->query()) }}" class="flex items-center justify-center space-x-1.5 px-3.5 py-2 border border-rose-200 bg-rose-50/50 hover:bg-rose-50 text-rose-700 font-bold text-xs rounded-xl transition">
                <span>📕</span>
                <span>Export PDF</span>
            </a>
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
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
