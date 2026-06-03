<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | TeFA Inventory</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;800&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-gradient-to-br from-orange-400 to-orange-600 min-h-screen flex items-center justify-center p-6">

    <div class="relative w-full max-w-[400px]">

        <div class="absolute -inset-1 bg-white/20 rounded-[2.5rem] blur-xl"></div>

        <div class="relative bg-white p-10 rounded-[2rem] shadow-[0_25px_50px_-12px_rgba(0,0,0,0.25)] border border-white/20">

            <div class="text-center mb-8">
                <div class="w-16 h-16 bg-orange-500 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg shadow-orange-500/30">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                </div>
                <h2 class="text-2xl font-extrabold text-slate-800">Login</h2>
                <p class="text-xs text-orange-500 font-bold uppercase tracking-[0.2em] mt-1">TeFA Inventory System</p>
            </div>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="space-y-4">
                    <input type="email" name="email" :value="old('email')" required placeholder="Alamat Email"
                           class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl focus:bg-white focus:border-orange-500 focus:ring-4 focus:ring-orange-500/10 outline-none transition duration-300 text-sm font-semibold text-slate-700">

                    <input type="password" name="password" required placeholder="Kata Sandi"
                           class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl focus:bg-white focus:border-orange-500 focus:ring-4 focus:ring-orange-500/10 outline-none transition duration-300 text-sm font-semibold text-slate-700">
                </div>

                <div class="flex items-center justify-between mt-6 mb-8">
                    <label class="flex items-center cursor-pointer">
                        <input type="checkbox" name="remember" class="w-4 h-4 rounded border-slate-300 text-orange-500 focus:ring-orange-500">
                        <span class="ml-2 text-[11px] font-bold text-slate-400 uppercase tracking-wider">Ingat saya</span>
                    </label>
                    <a href="{{ route('password.request') }}" class="text-[11px] font-bold text-orange-500 hover:text-orange-600">LUPA PASSWORD?</a>
                </div>

                <button type="submit"
                        class="w-full bg-slate-900 text-white py-4 rounded-2xl font-bold text-sm tracking-wide shadow-lg shadow-slate-900/20 hover:bg-slate-800 transition duration-300">
                    MASUK KE SISTEM
                </button>
            </form>
        </div>

        <p class="mt-8 text-center text-[10px] text-white/70 font-bold uppercase tracking-widest">TeFA Inventory © 2026</p>
    </div>

</body>
</html>
