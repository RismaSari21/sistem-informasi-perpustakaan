<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-base text-gray-800 leading-tight">
            Dashboard Perpustakaan
        </h2>
    </x-slot>

    <div class="py-6 px-4 sm:px-6 bg-[#F0EBF7] min-h-screen">

        <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

            {{-- ================= KOLOM KIRI ================= --}}
            <div class="xl:col-span-2 space-y-6">

                {{-- HERO --}}
                <div class="bg-[#6C4E97] rounded-3xl p-8 text-white shadow-lg relative overflow-hidden">
                    <div class="absolute -top-10 -right-10 w-40 h-40 bg-white/10 rounded-full blur-2xl"></div>

                    <h1 class="text-3xl font-bold mb-2">
                        Halo, {{ Auth::user()->name }} 👋
                    </h1>

                    <p class="text-purple-100 max-w-lg text-sm">
                        Selamat datang di Sistem Informasi Perpustakaan. Kelola koleksi buku dengan lebih mudah.
                    </p>
                </div>

                {{-- QUICK STATS (HANYA BUKU) --}}
                <div class="grid grid-cols-1 md:grid-cols-1 gap-4">

                    <div class="bg-white p-6 rounded-2xl shadow-sm border">
                        <p class="text-xs text-gray-400">Total Buku</p>
                        <h3 class="text-3xl font-bold text-[#6C4E97]">
                            {{ $totalBuku }}
                        </h3>
                    </div>

                </div>

                {{-- ================= BUKU COVER WARNA-WARNI ================= --}}
                <div>
                    <h3 class="font-bold text-gray-700 mb-3">📚 Buku Terbaru</h3>

                    <div class="grid grid-cols-2 md:grid-cols-3 gap-4">

                        @php
                            $covers = [
                                'bg-pink-400',
                                'bg-blue-400',
                                'bg-yellow-400',
                                'bg-green-400',
                                'bg-purple-400',
                                'bg-indigo-400',
                                'bg-rose-400',
                                'bg-emerald-400',
                                'bg-orange-400',
                            ];
                        @endphp

                        @foreach($recentBooks as $book)

                            @php
                                $cover = $covers[$loop->index % count($covers)];
                            @endphp

                            <div class="bg-white rounded-2xl shadow-sm border hover:shadow-md transition overflow-hidden">

                                <div class="h-28 {{ $cover }} flex items-center justify-center relative">
                                    <div class="absolute left-0 top-0 bottom-0 w-2 bg-black/10"></div>
                                    <span class="text-white text-2xl">📘</span>
                                </div>

                                <div class="p-3">
                                    <h4 class="font-bold text-sm text-gray-800 truncate">
                                        {{ $book->judul }}
                                    </h4>
                                    <p class="text-xs text-gray-400 truncate">
                                        {{ $book->penulis }}
                                    </p>
                                </div>

                            </div>

                        @endforeach

                    </div>
                </div>

            </div>

            {{-- ================= KOLOM KANAN ================= --}}
            <div class="space-y-6">

                {{-- TOTAL --}}
                <div class="bg-white p-6 rounded-3xl border shadow-sm">
                    <p class="text-gray-400 text-sm">Total Koleksi Buku</p>
                    <h2 class="text-4xl font-extrabold text-[#6C4E97]">
                        {{ $totalBuku }}
                    </h2>
                </div>

                {{-- GRAFIK WARNA-WARNI --}}
                <div class="bg-white p-6 rounded-3xl border shadow-sm">
                    <h3 class="font-bold text-gray-700 mb-6">Distribusi Kategori</h3>

                    <div class="space-y-5">

                        @php
                            $bars = [
                                'bg-pink-500',
                                'bg-blue-500',
                                'bg-yellow-500',
                                'bg-green-500',
                                'bg-purple-500',
                                'bg-indigo-500',
                                'bg-orange-500',
                            ];
                        @endphp

                        @foreach($categoryStats as $cat)

                            @php
                                $bar = $bars[$loop->index % count($bars)];
                            @endphp

                            <div>

                                <div class="flex justify-between text-xs mb-1">
                                    <span class="font-semibold text-gray-600">
                                        {{ $cat['label'] }}
                                    </span>
                                    <span class="text-[#6C4E97]">
                                        {{ $cat['percentage'] }}%
                                    </span>
                                </div>

                                <div class="w-full bg-purple-100 h-2 rounded-full overflow-hidden">
                                    <div class="h-full rounded-full {{ $bar }}"
                                         style="width: {{ $cat['percentage'] }}%;">
                                    </div>
                                </div>

                            </div>

                        @endforeach

                    </div>
                </div>

                {{-- AKTIVITAS SEDERHANA --}}
                <div class="bg-white p-6 rounded-3xl border shadow-sm">
                    <h3 class="font-bold text-gray-700 mb-3">🕒 Aktivitas</h3>

                    <ul class="text-xs text-gray-500 space-y-2">
                        <li>✔ Buku terbaru ditambahkan</li>
                        <li>✔ Data perpustakaan diperbarui</li>
                        <li>✔ Sistem berjalan normal</li>
                    </ul>
                </div>

                {{-- ACTION --}}
                <div class="bg-[#6C4E97] text-white p-6 rounded-3xl">
                    <h4 class="font-bold mb-2">Kelola Buku</h4>
                    <p class="text-xs text-purple-100 mb-4">
                        Tambahkan koleksi buku baru ke sistem.
                    </p>

                    <a href="{{ route('books.create') }}"
                       class="block text-center bg-white text-[#6C4E97] text-xs font-bold py-3 rounded-xl hover:bg-gray-100">
                        + Tambah Buku
                    </a>
                </div>

            </div>

        </div>
    </div>

</x-app-layout>