<x-app-layout>
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-8 gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Katalog Inventaris</h1>
            <p class="text-sm text-slate-500 mt-1">Manajemen komoditas unit dan aset ruang produksi TeFA.</p>
        </div>
        <a href="{{ route('barang.create') }}" class="inline-flex items-center justify-center px-5 py-2.5 bg-gradient-to-r from-orange-500 to-amber-500 text-white font-bold text-sm rounded-xl hover:opacity-90 transition shadow-md shadow-orange-500/15">
            + Tambah Aset Barang
        </a>
    </div>

    <form method="GET" action="{{ route('barang.index') }}" class="bg-white p-4 rounded-2xl border border-slate-100 shadow-sm flex flex-col md:flex-row gap-4 mb-6">
        <div class="flex-1 relative">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama barang atau kode..." class="w-full pl-4 pr-4 py-2.5 text-sm bg-slate-50/50 border border-slate-200/80 rounded-xl focus:outline-none focus:border-orange-500 focus:bg-white transition duration-200">
        </div>
        <div class="w-full md:w-48">
            <select name="kategori" class="w-full px-4 py-2.5 text-sm bg-slate-50/50 border border-slate-200/80 rounded-xl focus:outline-none focus:border-orange-500 focus:bg-white transition duration-200 text-slate-600 font-medium">
                <option value="">Semua Kategori</option>
                <option value="Laptop" {{ request('kategori') == 'Laptop' ? 'selected' : '' }}>Laptop</option>
                <option value="Aksesoris" {{ request('kategori') == 'Aksesoris' ? 'selected' : '' }}>Aksesoris</option>
            </select>
        </div>
        <button type="submit" class="px-6 py-2.5 bg-slate-900 text-white text-sm font-bold rounded-xl hover:bg-slate-800 transition shadow-sm">
            Terapkan
        </button>
    </form>

    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50/70 border-b border-slate-100 text-[11px] font-bold text-slate-400 uppercase tracking-widest">
                        <th class="p-4 pl-6 w-24">Visual</th>
                        <th class="p-4">Deskripsi Barang</th>
                        <th class="p-4">Kategori</th>
                        <th class="p-4">Volume Stok</th>
                        <th class="p-4">Kondisi</th>
                        <th class="p-4 text-center pr-6">Aksi Manajerial</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-sm text-slate-600">
                    @forelse($barangs as $barang)
                    <tr class="hover:bg-slate-50/50 transition duration-150">
                        <td class="p-4 pl-6">
                            @if($barang->foto_barang)
                                <img src="{{ asset('storage/' . $barang->foto_barang) }}" class="w-12 h-12 object-cover rounded-xl border border-slate-100 shadow-xs">
                            @else
                                <div class="w-12 h-12 bg-slate-100 rounded-xl flex items-center justify-center text-[10px] text-slate-400 font-bold border border-slate-200/50">NO IMG</div>
                            @endif
                        </td>
                        <td class="p-4">
                            <span class="font-bold text-slate-900 block text-base">{{ $barang->nama_barang }}</span>
                            <span class="text-xs text-slate-400 font-medium font-mono">ID: #00{{ $barang->id }}</span>
                        </td>
                        <td class="p-4">
                            <span class="font-semibold bg-slate-100 text-slate-600 px-2.5 py-1 rounded-lg text-xs">{{ $barang->kategori_barang }}</span>
                        </td>
                        <td class="p-4">
                            <span class="font-extrabold text-slate-900 text-base">{{ $barang->stok }}</span> <span class="text-xs text-slate-400 font-medium">Unit</span>
                        </td>
                        <td class="p-4">
                            <span class="inline-flex items-center px-2.5 py-1 text-xs font-bold rounded-full {{ $barang->kondisi_barang == 'Baik' ? 'bg-emerald-50 text-emerald-600 border border-emerald-100' : 'bg-amber-50 text-amber-600 border border-amber-100' }}">
                                <span class="w-1.5 h-1.5 rounded-full {{ $barang->kondisi_barang == 'Baik' ? 'bg-emerald-500' : 'bg-amber-500' }} mr-1.5"></span>
                                {{ $barang->kondisi_barang }}
                            </span>
                        </td>
                        <td class="p-4 text-center pr-6">
                            <div class="flex items-center justify-center space-x-2">
                                <a href="{{ route('barang.edit', $barang->id) }}" class="px-3 py-1.5 bg-slate-50 text-slate-700 rounded-lg text-xs font-bold hover:bg-orange-50 hover:text-orange-600 transition duration-150">Ubah</a>
                                <form action="{{ route('barang.destroy', $barang->id) }}" method="POST" onsubmit="return confirm('Hapus data barang ini secara permanen?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="px-3 py-1.5 bg-slate-50 text-red-600 rounded-lg text-xs font-bold hover:bg-red-50 transition duration-150">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="p-12 text-center text-slate-400 font-medium">Belum ada unit barang terdaftar di TeFA.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
