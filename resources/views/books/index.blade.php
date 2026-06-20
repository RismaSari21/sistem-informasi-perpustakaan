<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white tracking-tight">
            Data Buku
        </h2>
    </x-slot>

    <div class="min-h-screen bg-[#F0EBF7] py-6 sm:py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Alert Success --}}
            @if(session('success'))
                <div class="mb-5 p-4 rounded-xl bg-green-50 border border-green-100 text-green-600 text-xs font-medium flex items-center gap-2">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            {{-- Header Atas --}}
            <div class="flex flex-col sm:flex-row justify-between sm:items-center gap-4 mb-6">

                <div>
                    <h1 class="text-xl font-black text-gray-800 tracking-tight">
                        📚 Data Buku
                    </h1>
                    <p class="text-xs text-gray-400 mt-1">
                        Total {{ $books->total() }} buku terdaftar di sistem
                    </p>
                </div>

                <a href="{{ route('books.create') }}"
                    class="inline-flex items-center justify-center gap-2 bg-[#6C4E97] hover:bg-[#593E7D] text-white px-5 py-2.5 rounded-xl text-xs font-bold shadow-md shadow-purple-100 transition transform hover:-translate-y-0.5 cursor-pointer">
                    <i class="fa-solid fa-plus text-[10px]"></i>
                    Tambah Buku
                </a>

            </div>

            {{-- Bagian Pencarian --}}
            <div class="bg-white rounded-3xl border border-white/60 shadow-xl shadow-purple-900/5 p-5 mb-6">

                <form method="GET" action="{{ route('books.index') }}">

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-3">

                        <input
                            type="text"
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="Cari kode buku, judul atau penulis..."
                            class="border border-gray-200 rounded-xl px-4 py-2.5 bg-gray-50/40 text-xs text-gray-700 focus:border-[#8F74B4] focus:ring-4 focus:ring-[#EAE2F3] transition-all outline-none">

                        <select
                            name="kategori"
                            class="border border-gray-200 rounded-xl px-4 py-2.5 bg-gray-50/40 text-xs text-gray-700 focus:border-[#8F74B4] focus:ring-4 focus:ring-[#EAE2F3] transition-all outline-none appearance-none">

                            <option value="">Semua Kategori</option>

                            @foreach($kategori as $k)
                                <option value="{{ $k }}"
                                    {{ request('kategori') == $k ? 'selected' : '' }}>
                                    {{ $k }}
                                </option>
                            @endforeach

                        </select>

                        <button
                            type="submit"
                            class="bg-[#6C4E97] hover:bg-[#593E7D] text-white rounded-xl px-4 py-2.5 text-xs font-bold transition cursor-pointer">
                            Cari Buku
                        </button>

                    </div>

                </form>

            </div>

            {{-- Bagian Tabel --}}
            <div class="bg-white rounded-3xl border border-white/60 shadow-xl shadow-purple-900/5 overflow-hidden">

                <div class="overflow-x-auto">
                    <table class="w-full text-xs">

                        <thead class="bg-[#EAE2F3]/60 border-b border-gray-100 text-[#2F1D4A]">
                            <tr>
                                <th class="p-4 text-left font-black uppercase tracking-wider">No</th>
                                <th class="p-4 text-left font-black uppercase tracking-wider">Kode</th>
                                <th class="p-4 text-left font-black uppercase tracking-wider">Judul</th>
                                <th class="p-4 text-left font-black uppercase tracking-wider">Penulis</th>
                                <th class="p-4 text-left font-black uppercase tracking-wider">Penerbit</th>
                                <th class="p-4 text-left font-black uppercase tracking-wider">Tahun</th>
                                <th class="p-4 text-left font-black uppercase tracking-wider">Kategori</th>
                                <th class="p-4 text-left font-black uppercase tracking-wider">Stok</th>
                                <th class="p-4 text-center font-black uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-100">

                        @forelse($books as $index => $book)

                            <tr class="hover:bg-gray-50/60 transition">

                                <td class="p-4 text-gray-400 font-medium">
                                    {{ $books->firstItem() + $index }}
                                </td>

                                <td class="p-4 font-bold text-gray-800">
                                    {{ $book->kode_buku }}
                                </td>

                                <td class="p-4 text-gray-700 font-medium">
                                    {{ $book->judul }}
                                </td>

                                <td class="p-4 text-gray-600">
                                    {{ $book->penulis }}
                                </td>

                                <td class="p-4 text-gray-500">
                                    {{ $book->penerbit }}
                                </td>

                                <td class="p-4 text-gray-500">
                                    {{ $book->tahun }}
                                </td>

                                <td class="p-4">
                                    <span class="px-2.5 py-1 rounded-full bg-[#EAE2F3] text-[#6C4E97] text-[10px] font-black uppercase tracking-wider">
                                        {{ $book->kategori ?? '-' }}
                                    </span>
                                </td>

                                <td class="p-4">

                                    @if($book->stok > 5)
                                        <span class="px-2.5 py-1 rounded-full bg-green-50 text-green-700 text-[10px] font-bold">
                                            {{ $book->stok }} Buku
                                        </span>
                                    @else
                                        <span class="px-2.5 py-1 rounded-full bg-rose-50 text-rose-600 text-[10px] font-bold">
                                            {{ $book->stok }} Buku
                                        </span>
                                    @endif

                                </td>

                                <td class="p-4">

                                    <div class="flex justify-center items-center gap-1.5">

                                        <a href="{{ route('books.show', $book->id) }}"
                                            class="bg-[#EAE2F3] hover:bg-[#DFD4ED] text-[#6C4E97] px-3 py-1.5 rounded-lg text-[11px] font-bold transition cursor-pointer">
                                            Detail
                                        </a>

                                        <a href="{{ route('books.edit', $book->id) }}"
                                            class="bg-amber-50 hover:bg-amber-100 text-amber-600 px-3 py-1.5 rounded-lg text-[11px] font-bold transition cursor-pointer">
                                            Edit
                                        </a>

                                        <form
                                            action="{{ route('books.destroy', $book->id) }}"
                                            method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus buku ini?')">

                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="bg-rose-50 hover:bg-rose-100 text-rose-600 px-3 py-1.5 rounded-lg text-[11px] font-bold transition cursor-pointer">
                                                Hapus
                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="9" class="text-center py-12 text-gray-400 font-medium">
                                    Belum ada data buku yang tersimpan.
                                </td>
                            </tr>

                        @endforelse

                        </tbody>

                    </table>
                </div>

            </div>

            {{-- Komponen Pagination --}}
            <div class="mt-6">
                {{ $books->links() }}
            </div>

        </div>
    </div>

</x-app-layout>