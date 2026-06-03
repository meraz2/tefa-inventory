<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TeFA Inventory — Premium</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Plus Jakarta Sans', sans-serif; }</style>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#fcfcfd] text-slate-800 antialiased selection:bg-orange-500 selection:text-white">
    <div class="flex h-screen overflow-hidden">

        <aside class="w-68 bg-white border-r border-slate-100 flex flex-col justify-between shadow-[4px_0_24px_rgba(0,0,0,0.02)] z-10">
            <div class="p-6">
                <div class="flex items-center space-x-3 px-2">
                    <div class="w-10 h-10 bg-gradient-to-br from-orange-500 to-amber-500 rounded-xl flex items-center justify-center text-white font-bold shadow-lg shadow-orange-500/20 text-lg tracking-wider">
                        T
                    </div>
                    <div>
                        <span class="text-lg font-bold block leading-none text-slate-900">TeFA <span class="text-orange-500">Hub</span></span>
                        <span class="text-[10px] text-slate-400 font-medium uppercase tracking-widest">Inventory v1.2</span>
                    </div>
                </div>

                <nav class="mt-10 space-y-1.5">
                    <p class="text-[11px] font-bold text-slate-400 uppercase tracking-widest px-3 mb-3">Menu Utama</p>

                    <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 px-4 py-3 text-sm font-semibold rounded-xl transition duration-200 {{ request()->routeIs('dashboard') ? 'bg-gradient-to-r from-orange-500 to-amber-500 text-white shadow-md shadow-orange-500/10' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2V16zM14 16a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2V16z"/></svg>
                        <span>Dashboard</span>
                    </a>

                    <a href="{{ route('barang.index') }}" class="flex items-center space-x-3 px-4 py-3 text-sm font-semibold rounded-xl transition duration-200 {{ request()->routeIs('barang.*') ? 'bg-gradient-to-r from-orange-500 to-amber-500 text-white shadow-md shadow-orange-500/10' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                        <span>Data Barang</span>
                    </a>

                    <a href="{{ route('peminjam.index') }}" class="flex items-center space-x-3 px-4 py-3 text-sm font-semibold rounded-xl transition duration-200 {{ request()->routeIs('peminjam.*') ? 'bg-gradient-to-r from-orange-500 to-amber-500 text-white shadow-md shadow-orange-500/10' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0-6a5.99 5.99 0 00-4-1.44A5.99 5.99 0 007 14.06M21 21v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                        <span>Data Peminjam</span>
                    </a>

                    @if(auth()->user()->role === 'admin')
                    <div class="pt-4">
                        <p class="text-[11px] font-bold text-slate-400 uppercase tracking-widest px-3 mb-3">Hak Akses Admin</p>
                        <a href="{{ route('peminjaman.index') }}" class="flex items-center space-x-3 px-4 py-3 text-sm font-semibold rounded-xl transition duration-200 {{ request()->routeIs('peminjaman.*') ? 'bg-gradient-to-r from-orange-500 to-amber-500 text-white shadow-md shadow-orange-500/10' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            <span>Log Peminjaman</span>
                        </a>
                    </div>
                    @endif
                </nav>
            </div>

            <div class="p-4 m-4 rounded-xl bg-slate-50 border border-slate-100 flex items-center justify-between">
                <div class="flex items-center space-x-3 truncate">
                    <div class="w-9 h-9 rounded-lg bg-orange-100 flex items-center justify-center text-orange-600 font-bold uppercase text-sm">
                        {{ substr(auth()->user()->name, 0, 2) }}
                    </div>
                    <div class="truncate">
                        <p class="text-xs font-bold text-slate-800 leading-tight truncate">{{ auth()->user()->name }}</p>
                        <span class="text-[10px] font-medium bg-orange-500/10 text-orange-600 px-1.5 py-0.5 rounded uppercase tracking-wider">{{ auth()->user()->role }}</span>
                    </div>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="p-1.5 text-slate-400 hover:text-red-500 hover:bg-white hover:shadow-sm rounded-lg transition duration-200">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                    </button>
                </form>
            </div>
        </aside>

        <main class="flex-1 overflow-y-auto p-8 lg:p-10">
            @if(session('success'))
                <div class="mb-6 p-4 bg-emerald-50 border border-emerald-100 text-emerald-800 rounded-2xl flex items-center space-x-3 shadow-sm animate-fade-in-down">
                    <span class="w-6 h-6 rounded-full bg-emerald-500 text-white flex items-center justify-center text-xs font-bold">✓</span>
                    <span class="text-sm font-semibold">{{ session('success') }}</span>
                </div>
            @endif
            {{ $slot }}
        </main>
    </div>
</body>
</html>
