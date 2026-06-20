<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white tracking-tight">
            Detail Buku
        </h2>
    </x-slot>

    <div class="min-h-screen bg-[#F0EBF7] py-6 sm:py-8">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Breadcrumb --}}
            <div class="flex items-center gap-2 text-sm text-gray-400 mb-5">
                <a href="{{ route('books.index') }}" class="hover:text-[#6C4E97] transition font-medium">
                    Data Buku
                </a>

                <svg class="w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                </svg>

                <span class="text-gray-600 truncate max-w-[200px]">
                    {{ $book->judul }}
                </span>
            </div>

            {{-- CARD --}}
            <div class="bg-white rounded-3xl border border-white/60 shadow-xl shadow-purple-900/5 overflow-hidden">

                {{-- HEADER CARD (Gradasi disesuaikan ke skema warna ungu tua baru) --}}
                <div class="bg-gradient-to-r from-[#6C4E97] to-[#8F74B4] p-6 sm:p-8 flex items-center gap-4 sm:gap-5">

                    <div class="w-14 h-18 sm:w-16 sm:h-20 bg-white/20 rounded-2xl flex items-center justify-center text-3xl sm:text-4xl flex-shrink-0">
                        📚
                    </div>

                    <div class="min-w-0">
                        <h1 class="text-lg sm:text-xl font-black text-white tracking-tight truncate">
                            {{ $book->judul }}
                        </h1>

                        <p class="text-white/80 text-xs mt-1 truncate">
                            Oleh: <span class="font-semibold">{{ $book->penulis }}</span>
                        </p>

                        @if($book->kategori)
                            <span class="inline-block mt-2 bg-white/20 text-white text-[10px] font-black uppercase tracking-wider px-2.5 py-1 rounded-full">
                                {{ $book->kategori }}
                            </span>
                        @endif
                    </div>

                </div>

                {{-- CONTENT --}}
                <div class="p-5 sm:p-8">

                    {{-- GRID INFO --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-6">

                        <div class="bg-gray-50/60 border border-gray-100 rounded-xl p-4">
                            <p class="text-[10px] font-black text-gray-400 uppercase tracking-wider mb-1">Penerbit</p>
                            <p class="text-xs font-semibold text-gray-800">
                                {{ $book->penerbit ?? '—' }}
                            </p>
                        </div>

                        <div class="bg-gray-50/60 border border-gray-100 rounded-xl p-4">
                            <p class="text-[10px] font-black text-gray-400 uppercase tracking-wider mb-1">Tahun Terbit</p>
                            <p class="text-xs font-semibold text-gray-800">
                                {{ $book->tahun ?? '—' }}
                            </p>
                        </div>

                        <div class="bg-gray-50/60 border border-gray-100 rounded-xl p-4">
                            <p class="text-[10px] font-black text-gray-400 uppercase tracking-wider mb-1">Kategori</p>
                            <p class="text-xs font-semibold text-gray-800">
                                {{ $book->kategori ?? '—' }}
                            </p>
                        </div>

                        <div class="bg-gray-50/60 border border-gray-100 rounded-xl p-4">
                            <p class="text-[10px] font-black text-gray-400 uppercase tracking-wider mb-1">Stok Tersedia</p>
                            <p class="text-xs font-black {{ $book->stok > 0 ? 'text-green-600' : 'text-red-500' }}">
                                {{ $book->stok ?? 0 }} Buku
                            </p>
                        </div>

                    </div>

                    {{-- DESKRIPSI --}}
                    @if($book->deskripsi)
                        <div class="mb-6">
                            <p class="text-[10px] font-black text-gray-400 uppercase tracking-wider mb-2">
                                Deskripsi Buku
                            </p>

                            <p class="text-xs text-gray-600 leading-relaxed bg-gray-50/40 p-4 rounded-xl border border-gray-100">
                                {{ $book->deskripsi }}
                            </p>
                        </div>
                    @endif

                    {{-- TIMESTAMP --}}
                    <div class="text-[11px] text-gray-400 border-t border-gray-100 pt-4 mb-6 font-medium">
                        Ditambahkan {{ $book->created_at->diffForHumans() }}

                        @if($book->updated_at != $book->created_at)
                            · Diperbarui {{ $book->updated_at->diffForHumans() }}
                        @endif
                    </div>

                    {{-- ACTION BUTTONS --}}
                    <div class="flex flex-col sm:flex-row gap-3 sm:items-center">

                        <a href="{{ route('books.index') }}"
                           class="px-5 py-2.5 text-xs font-bold text-gray-500 bg-gray-100 rounded-xl hover:bg-gray-200 transition text-center cursor-pointer">
                            ← Kembali
                        </a>

                        <a href="{{ route('books.edit', $book->id) }}"
                           class="px-5 py-2.5 text-xs font-bold text-white bg-[#6C4E97] rounded-xl hover:bg-[#593E7D] shadow-md shadow-purple-100 transition transform hover:-translate-y-0.5 text-center cursor-pointer">
                            Edit Buku
                        </a>

                        {{-- DELETE --}}
                        <form action="{{ route('books.destroy', $book->id) }}" method="POST"
                              onsubmit="return confirm('Yakin ingin menghapus buku ini?')"
                              class="sm:ml-auto w-full sm:w-auto">

                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                class="px-5 py-2.5 text-xs font-bold text-red-500 hover:text-red-700 hover:bg-red-50 rounded-xl transition w-full sm:w-auto cursor-pointer text-center sm:text-right">
                                Hapus Buku
                            </button>

                        </form>

                    </div>

                </div>

            </div>

        </div>
    </div>

</x-app-layout>