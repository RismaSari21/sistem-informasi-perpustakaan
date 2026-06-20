<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white tracking-tight">Edit Buku</h2>
    </x-slot>

    <div class="min-h-screen bg-[#F0EBF7] py-6 sm:py-8">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Breadcrumb --}}
            <div class="flex items-center gap-2 text-sm text-gray-400 mb-5">
                <a href="{{ route('books.index') }}" class="hover:text-[#6C4E97] font-medium">Data Buku</a>
                <span>/</span>
                <span class="text-gray-600 truncate max-w-[200px]">
                    Edit: {{ $book->judul }}
                </span>
            </div>

            {{-- CARD --}}
            <div class="bg-white rounded-3xl border border-white/60 p-5 sm:p-8 shadow-xl shadow-purple-900/5">

                <div class="mb-6">
                    <h1 class="text-xl font-black text-gray-800">Edit Data Buku</h1>
                    <p class="text-xs text-gray-400 mt-1">Perbarui informasi buku di bawah ini</p>
                </div>

                {{-- ERROR --}}
                @if ($errors->any())
                    <div class="mb-5 p-4 bg-red-50 border border-red-200 text-red-600 rounded-xl">
                        <ul class="list-disc ml-5 text-xs space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- FORM UPDATE --}}
                <form action="{{ route('books.update', $book->id) }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')

                    {{-- KODE BUKU --}}
                    <div>
                        <label class="text-[10px] font-bold text-gray-400 uppercase">Kode Buku</label>
                        <input type="text" name="kode_buku"
                               value="{{ old('kode_buku', $book->kode_buku) }}" required
                               class="w-full mt-1.5 px-4 py-2.5 rounded-xl border border-gray-200
                                      bg-gray-50/40 text-xs focus:border-[#8F74B4] focus:ring-4 focus:ring-[#EAE2F3]">
                    </div>

                    {{-- JUDUL --}}
                    <div>
                        <label class="text-[10px] font-bold text-gray-400 uppercase">Judul Buku</label>
                        <input type="text" name="judul"
                               value="{{ old('judul', $book->judul) }}" required
                               class="w-full mt-1.5 px-4 py-2.5 rounded-xl border border-gray-200
                                      bg-gray-50/40 text-xs focus:border-[#8F74B4] focus:ring-4 focus:ring-[#EAE2F3]">
                    </div>

                    {{-- PENULIS --}}
                    <div>
                        <label class="text-[10px] font-bold text-gray-400 uppercase">Penulis</label>
                        <input type="text" name="penulis"
                               value="{{ old('penulis', $book->penulis) }}" required
                               class="w-full mt-1.5 px-4 py-2.5 rounded-xl border border-gray-200
                                      bg-gray-50/40 text-xs focus:border-[#8F74B4] focus:ring-4 focus:ring-[#EAE2F3]">
                    </div>

                    {{-- PENERBIT & TAHUN --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="text-[10px] font-bold text-gray-400 uppercase">Penerbit</label>
                            <input type="text" name="penerbit"
                                   value="{{ old('penerbit', $book->penerbit) }}" required
                                   class="w-full mt-1.5 px-4 py-2.5 rounded-xl border border-gray-200
                                          bg-gray-50/40 text-xs focus:border-[#8F74B4] focus:ring-4 focus:ring-[#EAE2F3]">
                        </div>

                        <div>
                            <label class="text-[10px] font-bold text-gray-400 uppercase">Tahun</label>
                            <input type="number" name="tahun"
                                   value="{{ old('tahun', $book->tahun) }}" required
                                   class="w-full mt-1.5 px-4 py-2.5 rounded-xl border border-gray-200
                                          bg-gray-50/40 text-xs focus:border-[#8F74B4] focus:ring-4 focus:ring-[#EAE2F3]">
                        </div>
                    </div>

                    {{-- KATEGORI & STOK --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="text-[10px] font-bold text-gray-400 uppercase">Kategori</label>
                            <select name="kategori"
                                    class="w-full mt-1.5 px-4 py-2.5 rounded-xl border border-gray-200
                                           bg-gray-50/40 text-xs focus:border-[#8F74B4] focus:ring-4 focus:ring-[#EAE2F3]">
                                <option value="">-- Pilih --</option>
                                @foreach(['Fiksi','Non-Fiksi','Sains','Sejarah','Novel','Teknologi','Pendidikan'] as $k)
                                    <option value="{{ $k }}"
                                        {{ old('kategori', $book->kategori) == $k ? 'selected' : '' }}>
                                        {{ $k }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="text-[10px] font-bold text-gray-400 uppercase">Stok</label>
                            <input type="number" name="stok"
                                   value="{{ old('stok', $book->stok) }}" required
                                   class="w-full mt-1.5 px-4 py-2.5 rounded-xl border border-gray-200
                                          bg-gray-50/40 text-xs focus:border-[#8F74B4] focus:ring-4 focus:ring-[#EAE2F3]">
                        </div>
                    </div>

                    {{-- ACTION --}}
                    <div class="flex flex-col sm:flex-row sm:justify-between items-center gap-3 pt-4">

                        <!-- DELETE -->
                        <button type="button"
                                onclick="if(confirm('Yakin ingin menghapus buku ini?')) document.getElementById('form-delete').submit();"
                                class="text-red-500 hover:text-red-700 text-xs font-bold self-start">
                            Hapus Buku
                        </button>

                        <!-- SAVE & CANCEL -->
                        <div class="flex gap-3 w-full sm:w-auto justify-end">

                            <a href="{{ route('books.index') }}"
                               class="px-5 py-2.5 text-xs font-bold bg-gray-100 text-gray-500 rounded-xl hover:bg-gray-200">
                                Batal
                            </a>

                            <button type="submit"
                                    class="px-6 py-2.5 text-xs font-bold text-white bg-[#6C4E97]
                                           hover:bg-[#593E7D] rounded-xl shadow-md">
                                Simpan
                            </button>

                        </div>

                    </div>

                </form>

                {{-- DELETE FORM --}}
                <form id="form-delete"
                      action="{{ route('books.destroy', $book->id) }}"
                      method="POST"
                      class="hidden">
                    @csrf
                    @method('DELETE')
                </form>

            </div>
        </div>
    </div>
</x-app-layout>