<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white tracking-tight">
            Tambah Data Buku
        </h2>
    </x-slot>

    <div class="min-h-screen bg-[#F0EBF7] py-6 sm:py-8">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Breadcrumb --}}
            <div class="flex items-center gap-2 text-sm text-gray-400 mb-5">
                <a href="{{ route('books.index') }}" class="hover:text-[#6C4E97] transition font-medium">
                    Data Buku
                </a>
                <span>/</span>
                <span class="text-gray-600">Tambah Data</span>
            </div>

            {{-- Card --}}
            <div class="bg-white rounded-3xl border border-white/60 p-5 sm:p-8 shadow-xl shadow-purple-900/5 relative">

                {{-- AUTO FILL BUTTON --}}
                <div class="absolute top-5 right-5 sm:top-8 sm:right-8">
                    <button type="button" onclick="isiDataOtomatis()" 
                        class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-[#EAE2F3] hover:bg-[#DFD4ED] text-[#6C4E97] text-xs font-bold rounded-xl transition shadow-sm border border-[#D7CBE7]/40 cursor-pointer">
                        Auto Generate Data
                    </button>
                </div>

                <div class="mb-6">
                    <h1 class="text-xl font-black text-gray-800 tracking-tight">
                        Form Tambah Buku
                    </h1>
                    <p class="text-xs text-gray-400 mt-1">
                        Lengkapi informasi buku untuk menambahkan data ke sistem perpustakaan
                    </p>
                </div>

                @if ($errors->any())
                    <div class="mb-5 p-4 bg-red-50 border border-red-200 text-red-600 rounded-xl">
                        <ul class="list-disc ml-5 text-xs font-medium space-y-0.5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('books.store') }}" method="POST" class="space-y-4">
                    @csrf

                    {{-- Kode Buku --}}
                    <div>
                        <label class="text-[10px] font-black text-gray-400 uppercase tracking-wider">
                            Kode Buku
                        </label>
                        <input type="text" name="kode_buku" id="kode_buku"
                            value="{{ old('kode_buku') }}" required
                            placeholder="Contoh: BK-1001"
                            class="w-full mt-1.5 border border-gray-200 rounded-xl px-4 py-2.5 bg-gray-50/40 text-xs text-gray-700 focus:border-[#8F74B4] focus:ring-4 focus:ring-[#EAE2F3] transition-all outline-none">
                    </div>

                    {{-- Judul --}}
                    <div>
                        <label class="text-[10px] font-black text-gray-400 uppercase tracking-wider">
                            Judul Buku
                        </label>
                        <input type="text" name="judul" id="judul"
                            value="{{ old('judul') }}" required
                            placeholder="Masukkan judul buku"
                            class="w-full mt-1.5 border border-gray-200 rounded-xl px-4 py-2.5 bg-gray-50/40 text-xs text-gray-700 focus:border-[#8F74B4] focus:ring-4 focus:ring-[#EAE2F3] transition-all outline-none">
                    </div>

                    {{-- Penulis --}}
                    <div>
                        <label class="text-[10px] font-black text-gray-400 uppercase tracking-wider">
                            Nama Penulis
                        </label>
                        <input type="text" name="penulis" id="penulis"
                            value="{{ old('penulis') }}" required
                            placeholder="Nama lengkap penulis"
                            class="w-full mt-1.5 border border-gray-200 rounded-xl px-4 py-2.5 bg-gray-50/40 text-xs text-gray-700 focus:border-[#8F74B4] focus:ring-4 focus:ring-[#EAE2F3] transition-all outline-none">
                    </div>

                    {{-- Penerbit + Tahun --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="text-[10px] font-black text-gray-400 uppercase tracking-wider">
                                Penerbit
                            </label>
                            <input type="text" name="penerbit" id="penerbit"
                                value="{{ old('penerbit') }}" required
                                placeholder="Nama penerbit buku"
                                class="w-full mt-1.5 border border-gray-200 rounded-xl px-4 py-2.5 bg-gray-50/40 text-xs text-gray-700 focus:border-[#8F74B4] focus:ring-4 focus:ring-[#EAE2F3] transition-all outline-none">
                        </div>
                        <div>
                            <label class="text-[10px] font-black text-gray-400 uppercase tracking-wider">
                                Tahun Terbit
                            </label>
                            <input type="number" name="tahun" id="tahun"
                                value="{{ old('tahun') }}" required
                                placeholder="Contoh: 2024"
                                class="w-full mt-1.5 border border-gray-200 rounded-xl px-4 py-2.5 bg-gray-50/40 text-xs text-gray-700 focus:border-[#8F74B4] focus:ring-4 focus:ring-[#EAE2F3] transition-all outline-none">
                        </div>
                    </div>

                    {{-- Kategori + Stok --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="text-[10px] font-black text-gray-400 uppercase tracking-wider">
                                Kategori Buku
                            </label>
                            <select name="kategori" id="kategori"
                                class="w-full mt-1.5 border border-gray-200 rounded-xl px-4 py-2.5 bg-gray-50/40 text-xs text-gray-700 focus:border-[#8F74B4] focus:ring-4 focus:ring-[#EAE2F3] transition-all outline-none appearance-none">
                                <option value="">-- Pilih Kategori --</option>
                                @foreach(['Fiksi','Non-Fiksi','Sains','Sejarah','Novel','Teknologi','Pendidikan'] as $k)
                                    <option value="{{ $k }}" {{ old('kategori') == $k ? 'selected' : '' }}>
                                        {{ $k }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="text-[10px] font-black text-gray-400 uppercase tracking-wider">
                                Jumlah Stok
                            </label>
                            <input type="number" name="stok" id="stok"
                                value="{{ old('stok') }}" required min="0"
                                placeholder="Jumlah stok tersedia"
                                class="w-full mt-1.5 border border-gray-200 rounded-xl px-4 py-2.5 bg-gray-50/40 text-xs text-gray-700 focus:border-[#8F74B4] focus:ring-4 focus:ring-[#EAE2F3] transition-all outline-none">
                        </div>
                    </div>

                    {{-- Buttons --}}
                    <div class="flex flex-col sm:flex-row sm:justify-end gap-3 pt-4">
                        <a href="{{ route('books.index') }}"
                            class="px-5 py-2.5 text-xs text-center font-bold bg-gray-100 text-gray-500 rounded-xl hover:bg-gray-200 transition">
                            Kembali
                        </a>

                        <button type="submit"
                            class="px-6 py-2.5 text-xs font-bold text-white bg-[#6C4E97] hover:bg-[#593E7D] rounded-xl shadow-md transition transform hover:-translate-y-0.5">
                            Simpan Buku
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- SCRIPT AUTO FILL --}}
    <script>
        function isiDataOtomatis() {
            const daftarJudul = [
                "Belajar Laravel Pemula",
                "Mastering Tailwind CSS",
                "Logika Pemrograman JavaScript",
                "Sistem Basis Data Modern"
            ];

            const daftarPenulis = [
                "Andi Wijaya",
                "Budi Santoso",
                "Siti Aminah",
                "Dewi Lestari"
            ];

            const daftarPenerbit = [
                "Informatika Bandung",
                "Elex Media",
                "Andi Offset"
            ];

            document.getElementById('kode_buku').value =
                "BK-" + Math.floor(1000 + Math.random() * 9000);

            document.getElementById('judul').value =
                daftarJudul[Math.floor(Math.random() * daftarJudul.length)];

            document.getElementById('penulis').value =
                daftarPenulis[Math.floor(Math.random() * daftarPenulis.length)];

            document.getElementById('penerbit').value =
                daftarPenerbit[Math.floor(Math.random() * daftarPenerbit.length)];

            document.getElementById('tahun').value =
                Math.floor(2020 + Math.random() * 7);

            document.getElementById('kategori').value = "Teknologi";

            document.getElementById('stok').value =
                Math.floor(5 + Math.random() * 20);
        }
    </script>

</x-app-layout>