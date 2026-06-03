<x-app-layout>
    <div class="max-w-xl bg-white p-8 rounded-2xl border border-slate-100 shadow-[0_10px_40px_rgba(0,0,0,0.02)] mx-auto">
        <div class="mb-6">
            <h2 class="text-xl font-bold text-slate-900 tracking-tight">Registrasi Item Baru</h2>
            <p class="text-xs text-slate-500 mt-1">Pastikan spesifikasi data barang diinput dengan valid.</p>
        </div>

        <form action="{{ route('barang.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf
            <div>
                <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-1.5">Nama Logistik / Alat</label>
                <input type="text" name="nama_barang" required placeholder="Masukkan nama barang..." class="w-full px-4 py-2.5 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:border-orange-500 focus:bg-white focus:ring-4 focus:ring-orange-500/10 transition duration-200">
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-1.5">Kategori Klasifikasi</label>
                <input type="text" name="kategori_barang" required placeholder="Misal: Laptop, Perkakas, Aksesoris" class="w-full px-4 py-2.5 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:border-orange-500 focus:bg-white focus:ring-4 focus:ring-orange-500/10 transition duration-200">
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-1.5">Volume Stok Awal</label>
                    <input type="number" name="stok" required min="0" placeholder="0" class="w-full px-4 py-2.5 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:border-orange-500 focus:bg-white focus:ring-4 focus:ring-orange-500/10 transition duration-200">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-1.5">Kondisi Fisik</label>
                    <select name="kondisi_barang" required class="w-full px-4 py-2.5 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:border-orange-500 focus:bg-white focus:ring-4 focus:ring-orange-500/10 transition duration-200 text-slate-700 font-medium">
                        <option value="Baik">Fungsional (Baik)</option>
                        <option value="Rusak Ringan">Defect (Rusak Ringan)</option>
                    </select>
                </div>
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-1.5">Lampiran Foto Dokumentasi</label>
                <input type="file" name="foto_barang" class="w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-orange-50 file:text-orange-600 hover:file:bg-orange-100 file:transition cursor-pointer">
            </div>

            <div class="pt-4 flex justify-end space-x-2 border-t border-slate-50">
                <a href="{{ route('barang.index') }}" class="px-4 py-2.5 border border-slate-200 rounded-xl text-xs font-bold text-slate-500 hover:bg-slate-50 transition">Kembali</a>
                <button type="submit" class="px-5 py-2.5 bg-gradient-to-r from-orange-500 to-amber-500 text-white text-xs font-bold rounded-xl shadow-md shadow-orange-500/15 transition hover:opacity-90">Simpan Logistik</button>
            </div>
        </form>
    </div>
</x-app-layout>
