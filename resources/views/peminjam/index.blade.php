<x-app-layout>
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Otoritas Peminjam</h1>
        <p class="text-sm text-slate-500 mt-1">Daftar entitas siswa yang terautentikasi melakukan pinjaman alat (Data Seeder Resmi).</p>
    </div>

    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50/70 border-b border-slate-100 text-[11px] font-bold text-slate-400 uppercase tracking-widest">
                    <th class="p-4 pl-6 w-20 text-center">Urutan</th>
                    <th class="p-4">Identitas Anggota</th>
                    <th class="p-4">Tingkat Kelas</th>
                    <th class="p-4">Program Keahlian</th>
                    <th class="p-4 pr-6">Kontak No. HP</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 text-sm text-slate-600">
                @forelse($peminjams as $index => $peminjam)
                <tr class="hover:bg-slate-50/50 transition">
                    <td class="p-4 text-center font-bold text-slate-400 font-mono">
                        {{ $peminjams->firstItem() + $index }}
                    </td>
                    <td class="p-4 font-bold text-slate-900 text-base">
                        {{ $peminjam->nama_peminjam }}
                    </td>
                    <td class="p-4">
                        <span class="px-3 py-1 text-xs font-bold rounded-xl bg-orange-50 text-orange-600 border border-orange-100">
                            Kelas {{ $peminjam->kelas }}
                        </span>
                    </td>
                    <td class="p-4 font-semibold text-slate-700">
                        {{ $peminjam->jurusan }}
                    </td>
                    <td class="p-4 pr-6 text-slate-500 font-mono text-xs">
                        {{ $peminjam->no_hp }}
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="p-12 text-center text-slate-400 font-medium">Tidak ada entitas siswa terdaftar.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $peminjams->links() }}
    </div>
</x-app-layout>
