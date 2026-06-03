<x-app-layout>
    <div class="max-w-xl bg-white p-8 rounded-2xl border border-slate-100 shadow-[0_10px_40px_rgba(0,0,0,0.02)] mx-auto">
        <div class="mb-6">
            <h2 class="text-xl font-bold text-slate-900 tracking-tight">Formulir Peminjaman Alat</h2>
            <p class="text-xs text-slate-500 mt-1">Sistem akan memvalidasi volume ketersediaan stok secara otomatis.</p>
        </div>

        @if ($errors->any())
            <div class="mb-4 p-4 bg-rose-50 border border-rose-100 text-rose-700 font-semibold rounded-xl text-xs">
                ⚠️ {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('peminjaman.store') }}" method="POST" class="space-y-5">
            @csrf
            <div>
                <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-1.5">Siswa Penanggung Jawab</label>
                <select name="peminjam_id" required class="w-full px-4 py-2.5 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:border-orange-500 focus:bg-white focus:ring-4 focus:ring-orange-500/10 transition duration-200 text-slate-700 font-semibold">
                    @foreach($peminjams as $p)
                        <option value="{{ $p->id }}">{{ $p->nama_peminjam }} — ({{ $p->kelas }} {{ $p->jurusan }})</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-1.5">Item Logistik TeFA</label>
                <select name="barang_id" required class="w-full px-4 py-2.5 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:border-orange-500 focus:bg-white focus:ring-4 focus:ring-orange-500/10 transition duration-200 text-slate-700 font-semibold">
                    @foreach($barangs as $b)
                        <option value="{{ $b->id }}">{{ $b->nama_barang }} [Stok Tersedia: {{ $b->stok }} Unit]</option>
                    @endforeach
                </select>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-1.5">Tanggal Distribusi</label>
                    <input type="date" name="tanggal_pinjam" required value="{{ date('Y-m-d') }}" class="w-full px-4 py-2.5 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:border-orange-500 focus:bg-white transition duration-200 text-slate-600 font-medium">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-1.5">Kuantitas Pinjam</label>
                    <input type="number" name="jumlah_pinjam" required min="1" value="1" class="w-full px-4 py-2.5 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:border-orange-500 focus:bg-white focus:ring-4 focus:ring-orange-500/10 transition duration-200 font-bold text-slate-900">
                </div>
            </div>

            <div class="pt-4 flex justify-end space-x-2 border-t border-slate-50">
                <a href="{{ route('peminjaman.index') }}" class="px-4 py-2.5 border border-slate-200 rounded-xl text-xs font-bold text-slate-500 hover:bg-slate-50 transition">Batal</a>
                <button type="submit" class="px-5 py-2.5 bg-slate-900 hover:bg-slate-800 text-white text-xs font-bold rounded-xl shadow-sm transition">Eksekusi Pinjaman</button>
            </div>
        </form>
    </div>
</x-app-layout>
