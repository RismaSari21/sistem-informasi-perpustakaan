<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white tracking-tight">Registrasi Anggota</h2>
    </x-slot>

    <div class="min-h-screen bg-[#F3F2FF] py-6 sm:py-8">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="bg-white rounded-2xl border border-gray-100 p-5 sm:p-8 shadow-sm relative">
                
                {{-- Tombol Autofill Cepat --}}
                <div class="absolute top-5 right-5 sm:top-8 sm:right-8">
                    <button type="button" onclick="autoFill()" 
                        class="px-3 py-1.5 bg-indigo-50 hover:bg-indigo-100 text-[#6C63FF] text-xs font-bold rounded-xl transition border border-indigo-100 shadow-sm">
                        ⚡ Isi Otomatis
                    </button>
                </div>

                <div class="mb-6">
                    <h1 class="text-lg font-semibold text-gray-800">Form Anggota Baru</h1>
                    <p class="text-sm text-gray-400 mt-1">Daftarkan identitas mahasiswa peminjam</p>
                </div>

                <form action="{{ route('transactions.store_member') }}" method="POST" class="space-y-5">
                    @csrf
                    <div>
                        <label class="text-sm font-medium text-gray-700">Nomor Anggota</label>
                        <input type="text" name="nomor_anggota" id="nomor_anggota" required class="w-full mt-1 border rounded-xl px-4 py-2.5 bg-gray-50 focus:border-[#6C63FF] outline-none transition text-sm">
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-700">Nama Lengkap</label>
                        <input type="text" name="nama" id="nama" required class="w-full mt-1 border rounded-xl px-4 py-2.5 bg-gray-50 focus:border-[#6C63FF] outline-none transition text-sm">
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="text-sm font-medium text-gray-700">Jenis Kelamin</label>
                            <select name="jenis_kelamin" id="jenis_kelamin" required class="w-full mt-1 border rounded-xl px-4 py-2.5 bg-gray-50 focus:border-[#6C63FF] outline-none text-sm">
                                <option value="">-- Pilih --</option>
                                <option value="L">Laki-laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-700">No. Telepon</label>
                            <input type="text" name="telepon" id="telepon" required class="w-full mt-1 border rounded-xl px-4 py-2.5 bg-gray-50 focus:border-[#6C63FF] outline-none transition text-sm">
                        </div>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-700">Alamat Rumah</label>
                        <textarea name="alamat" id="alamat" rows="3" required class="w-full mt-1 border rounded-xl px-4 py-2.5 bg-gray-50 focus:border-[#6C63FF] outline-none transition resize-none text-sm"></textarea>
                    </div>

                    <div class="flex justify-end gap-3 pt-3">
                        <a href="{{ route('transactions.index') }}" class="px-5 py-2.5 text-sm bg-gray-100 rounded-xl hover:bg-gray-200 transition text-center font-medium">Batal</a>
                        <button type="submit" class="px-5 py-2.5 text-sm text-white bg-[#6C63FF] rounded-xl hover:bg-[#5A52E0] transition shadow-sm font-medium">Simpan Anggota</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function autoFill() {
            document.getElementById('nomor_anggota').value = "NIM-" + Math.floor(100000 + Math.random() * 900000);
            document.getElementById('nama').value = "Triyas Nurlita";
            document.getElementById('jenis_kelamin').value = "P";
            document.getElementById('telepon').value = "085298765432";
            document.getElementById('alamat').value = "Sleman, Yogyakarta";
        }
    </script>
</x-app-layout>