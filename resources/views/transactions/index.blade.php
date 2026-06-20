<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white tracking-tight">Sirkulasi Perpustakaan</h2>
    </x-slot>

    <div class="min-h-screen bg-[#F3F2FF] py-6 sm:py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-9">

            {{-- Flash Message Alert --}}
            @if(session('success'))
                <div class="p-4 rounded-xl bg-green-50 border border-green-200 text-green-700 text-sm shadow-sm flex items-center gap-2">
                    ✅ {{ session('success') }}
                </div>
            @endif

            {{-- ================= TABEL 1: DATA ANGGOTA ================= --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5 sm:p-8">
                <div class="flex flex-col sm:flex-row justify-between sm:items-center gap-4 mb-6">
                    <div>
                        <h1 class="text-lg font-semibold text-gray-800">👤 Data Anggota / Mahasiswa</h1>
                        <p class="text-sm text-gray-400 mt-1">Daftar peminjam aktif perpustakaan</p>
                    </div>
                    <a href="{{ route('transactions.create_member') }}"
                        class="inline-flex items-center justify-center bg-[#6C63FF] hover:bg-[#5A52E0] text-white px-5 py-2.5 rounded-xl text-sm font-medium transition shadow-sm text-center">
                        + Registrasi Anggota Baru
                    </a>
                </div>

                <div class="overflow-x-auto rounded-xl border border-gray-100">
                    <table class="w-full text-sm">
                        <thead class="bg-[#F3F2FF]">
                            <tr>
                                <th class="p-4 text-left text-xs font-semibold text-gray-500 uppercase">No. Anggota</th>
                                <th class="p-4 text-left text-xs font-semibold text-gray-500 uppercase">Nama Lengkap</th>
                                <th class="p-4 text-left text-xs font-semibold text-gray-500 uppercase">Gender</th>
                                <th class="p-4 text-left text-xs font-semibold text-gray-500 uppercase">No. Telp</th>
                                <th class="p-4 text-left text-xs font-semibold text-gray-500 uppercase">Alamat</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($members as $member)
                                <tr class="hover:bg-gray-50/60 transition">
                                    <td class="p-4 font-semibold text-gray-800">{{ $member->nomor_anggota }}</td>
                                    <td class="p-4 text-gray-700 font-medium">{{ $member->nama }}</td>
                                    <td class="p-4">
                                        <span class="px-2 py-0.5 rounded text-xs font-bold {{ $member->jenis_kelamin == 'L' ? 'bg-blue-50 text-blue-600' : 'bg-pink-50 text-pink-600' }}">
                                            {{ $member->jenis_kelamin }}
                                        </span>
                                    </td>
                                    <td class="p-4 text-gray-600">{{ $member->telepon }}</td>
                                    <td class="p-4 text-gray-500 max-w-xs truncate">{{ $member->alamat }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-8 text-gray-400">Belum ada data anggota terdaftar.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- ================= TABEL 2: GABUNGAN PEMINJAMAN & PENGEMBALIAN ================= --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5 sm:p-8">
                <div class="flex flex-col sm:flex-row justify-between sm:items-center gap-4 mb-6">
                    <div>
                        <h1 class="text-lg font-semibold text-gray-800">📑 Sirkulasi Peminjaman & Pengembalian</h1>
                        <p class="text-sm text-gray-400 mt-1">Alur transaksi peminjaman buku perpustakaan</p>
                    </div>
                    <a href="{{ route('transactions.create_peminjaman') }}"
                        class="inline-flex items-center justify-center bg-emerald-600 hover:bg-emerald-700 text-white px-5 py-2.5 rounded-xl text-sm font-medium transition shadow-sm text-center">
                        📖 Catat Peminjaman Buku
                    </a>
                </div>

                <div class="overflow-x-auto rounded-xl border border-gray-100">
                    <table class="w-full text-sm">
                        <thead class="bg-[#F3F2FF]">
                            <tr>
                                <th class="p-4 text-left text-xs font-semibold text-gray-500 uppercase">Kode Trx</th>
                                <th class="p-4 text-left text-xs font-semibold text-gray-500 uppercase">Nama Peminjam</th>
                                <th class="p-4 text-left text-xs font-semibold text-gray-500 uppercase">Buku Yang Dipinjam</th>
                                <th class="p-4 text-left text-xs font-semibold text-gray-500 uppercase">Tgl Pinjam</th>
                                <th class="p-4 text-left text-xs font-semibold text-gray-500 uppercase">Tgl Kembali</th>
                                <th class="p-4 text-center text-xs font-semibold text-gray-500 uppercase">Status</th>
                                <th class="p-4 text-center text-xs font-semibold text-gray-500 uppercase">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($transactions as $trx)
                                <tr class="hover:bg-gray-50/60 transition">
                                    <td class="p-4 font-mono font-bold text-gray-800">{{ $trx->kode_transaksi }}</td>
                                    <td class="p-4 text-gray-700 font-medium">{{ $trx->member->nama }}</td>
                                    <td class="p-4 text-gray-600">{{ $trx->book->judul }}</td>
                                    <td class="p-4 text-gray-600">{{ \Carbon\Carbon::parse($trx->tanggal_pinjam)->format('d M Y') }}</td>
                                    <td class="p-4 text-gray-600">
                                        {{ $trx->tanggal_kembali ? \Carbon\Carbon::parse($trx->tanggal_kembali)->format('d M Y') : '-' }}
                                    </td>
                                    <td class="p-4 text-center">
                                        @if($trx->status == 'dipinjam')
                                            <span class="px-2.5 py-1 rounded-full text-xs font-semibold bg-amber-50 text-amber-600 border border-amber-200">Dipinjam</span>
                                        @else
                                            <span class="px-2.5 py-1 rounded-full text-xs font-semibold bg-green-50 text-green-600 border border-green-200">Selesai</span>
                                        @endif
                                    </td>
                                    <td class="p-4 text-center">
                                        @if($trx->status == 'dipinjam')
                                            {{-- Form Pengembalian Langsung --}}
                                            <form action="{{ route('transactions.return_buku', $trx->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" onclick="return confirm('Proses pengembalian buku ini?')"
                                                    class="bg-emerald-50 hover:bg-emerald-100 text-emerald-600 px-3 py-1.5 rounded-lg text-xs font-bold transition border border-emerald-200 shadow-sm">
                                                    ↩️ Kembalikan
                                                </button>
                                            </form>
                                        @else
                                            <span class="text-xs text-gray-400 bg-gray-50 px-2 py-1 rounded border border-gray-100">Arsip</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-8 text-gray-400">Belum ada riwayat sirkulasi sirkulasi.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>