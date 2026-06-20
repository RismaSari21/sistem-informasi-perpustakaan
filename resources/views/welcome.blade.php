<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Perpustakaan Digital</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#F3F2FF] h-screen flex items-center justify-center">

    <div class="bg-white w-[400px] p-10 rounded-[2rem] shadow-xl border border-indigo-50 text-center">
        
        <div class="bg-indigo-600 w-20 h-20 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg shadow-indigo-200">
            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
        </div>

        <h2 class="text-2xl font-bold text-gray-800 mb-2">Selamat Datang</h2>
        <p class="text-gray-500 mb-8">Kelola buku perpustakaan Anda dengan gaya modern.</p>

        <div class="space-y-3">
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}" class="block w-full py-3.5 bg-indigo-600 text-white font-semibold rounded-xl hover:bg-indigo-700 transition">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="block w-full py-3.5 bg-indigo-600 text-white font-semibold rounded-xl hover:bg-indigo-700 transition">Masuk ke Sistem</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="block w-full py-3.5 bg-gray-100 text-gray-700 font-semibold rounded-xl hover:bg-gray-200 transition">Daftar Baru</a>
                    @endif
                @endauth
            @endif
        </div>
    </div>

</body>
</html>