<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white tracking-tight">Peminjaman Baru</h2>
    </x-slot>

    <div class="min-h-screen bg-[#F3F2FF] py-6 sm:py-8">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="bg-white rounded-2xl border border-gray-100 p-5 sm:p-8 shadow-sm">
                <div class="mb-6">
                    <h1 class="text-lg font-semibold text-gray-800">Form Transaksi Peminjaman</h1>
                    <p class="text-sm text-gray-400 mt-1">Pilih nama peminjam beserta buku yang ingin dipinjam</p>
                </div>

                <form action="{{ route('transactions.store_peminjaman') }}" method="POST" class="space-y-5">
                    @csrf

                    <div>
                        <label class="text-sm font-medium text-gray-700">Kode Transaksi</label>
                        <input type="text" name="kode_transaksi" value="TRX-{{ strtoupper(Str::random(5)) }}" readonly class="w-full mt-1 border rounded-xl px-4 py-2.5 bg-gray-100 font-mono text-gray-500 cursor-not-allowed outline-none text-sm">
                    </div>

                    {{-- Dropdown Pilih Anggota --}}
                    <div>
                        <label class="text-sm font-medium text-gray-700">Pilih Anggota Peminjam</label>
                        <select name="member_id" required class="w-full mt-1 border rounded-xl px-4 py-2.5 bg-gray-50 focus:border-[#6C63FF] outline-none text-sm">
                            <option value="">-- Cari Nama Anggota --</option>
                            @foreach($members as $m)
                                <option value="{{ $m->id }}">{{ $m->nomor_anggota }} - {{ $m->nama }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Dropdown Pilih Buku --}}
                    <div>
                        <label class="text-sm font-medium text-gray-700">Pilih Buku Perpustakaan</label>
                        <select name="book_id" required class="w-full mt-1 border rounded-xl px-4 py-2.5 bg-gray-50 focus:border-[#6C63FF] outline-none text-sm">
                            <option value="">-- Cari Judul Buku --</option>
                            @foreach($books as $b)
                                <option value="{{ $b->id }}" {{ $b->stok < 1 ? 'disabled class=text-gray-300' : '' }}>
                                    {{ $b->judul }} {{ $b->stok < 1 ? '(STOK HABIS)' : '(Sisa Stok: '.$b->stok.')' }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="text-sm font-medium text-gray-700">Tanggal Pinjam</label>
                        <input type="date" name="tanggal_pinjam" value="{{ date('Y-m-d') }}" required class="w-full mt-1 border rounded-xl px-4 py-2.5 bg-gray-50 focus:border-[#6C63FF] outline-none text-sm">
                    </div>

                    <div class="flex justify-end gap-3 pt-3">
                        <a href="{{ route('transactions.index') }}" class="px-5 py-2.5 text-sm bg-gray-100 rounded-xl hover:bg-gray-200 transition text-center font-medium">Batal</a>
                        <button type="submit" class="px-5 py-2.5 text-sm text-white bg-emerald-600 hover:bg-emerald-700 rounded-xl transition shadow-sm font-medium">Konfirmasi Pinjaman</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>