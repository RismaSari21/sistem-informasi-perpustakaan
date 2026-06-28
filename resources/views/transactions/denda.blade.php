<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-xs font-semibold uppercase tracking-widest text-[#8F74B4]">Transaksi</p>
                <h2 class="text-xl font-semibold text-gray-900 tracking-tight">Denda Keterlambatan</h2>
            </div>
            <a href="{{ route('transactions.index') }}" class="rounded-lg border border-[#DCD3EA] bg-[#F8F5FC] px-3 py-2 text-sm font-semibold text-[#6C4E97] transition hover:bg-[#F0EBF7]">
                Kembali
            </a>
        </div>
    </x-slot>

    <div class="min-h-screen bg-[#F7F6FB] py-6 sm:py-8">
        <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8 space-y-6">
            <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-3">
                <div class="rounded-lg border border-gray-100 bg-white p-5 shadow-sm">
                    <p class="text-sm text-gray-500">Total Denda Terkumpul</p>
                    <p class="mt-2 text-2xl font-bold text-gray-900">Rp {{ number_format($totalDenda, 0, ',', '.') }}</p>
                </div>
                <div class="rounded-lg border border-gray-100 bg-white p-5 shadow-sm">
                    <p class="text-sm text-gray-500">Transaksi Terlambat</p>
                    <p class="mt-2 text-2xl font-bold text-gray-900">{{ $transactions->count() }}</p>
                </div>
                <div class="rounded-lg border border-gray-100 bg-white p-5 shadow-sm">
                    <p class="text-sm text-gray-500">Catatan</p>
                    <p class="mt-2 text-sm text-gray-600">Denda dihitung dari selisih tanggal kembali dengan jatuh tempo.</p>
                </div>
            </div>

            <section class="rounded-lg border border-gray-100 bg-white shadow-sm">
                <div class="border-b border-gray-100 px-5 py-4">
                    <h2 class="text-base font-semibold text-gray-900">Daftar Denda</h2>
                    <p class="text-sm text-gray-500">Transaksi yang memiliki denda keterlambatan.</p>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full min-w-[900px] text-sm">
                        <thead class="bg-[#F0EBF7] text-xs font-bold uppercase tracking-wider text-[#6C4E97]">
                            <tr>
                                <th class="px-5 py-3 text-left">Kode</th>
                                <th class="px-5 py-3 text-left">Anggota</th>
                                <th class="px-5 py-3 text-left">Buku</th>
                                <th class="px-5 py-3 text-left">Jatuh Tempo</th>
                                <th class="px-5 py-3 text-left">Kembali</th>
                                <th class="px-5 py-3 text-left">Terlambat</th>
                                <th class="px-5 py-3 text-left">Denda/Hari</th>
                                <th class="px-5 py-3 text-left">Total Denda</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($transactions as $trx)
                                <tr class="transition hover:bg-[#FAF8FD]">
                                    <td class="px-5 py-4 font-mono text-xs font-bold text-gray-800">{{ $trx->kode_transaksi }}</td>
                                    <td class="px-5 py-4">
                                        <p class="font-semibold text-gray-800">{{ $trx->member->nama }}</p>
                                        <p class="text-xs text-gray-400">{{ $trx->member->nomor_anggota }}</p>
                                    </td>
                                    <td class="px-5 py-4 text-gray-600">{{ $trx->book->judul }}</td>
                                    <td class="px-5 py-4 text-gray-600">{{ \Carbon\Carbon::parse($trx->jatuh_tempo)->format('d M Y') }}</td>
                                    <td class="px-5 py-4 text-gray-600">{{ $trx->tanggal_kembali ? \Carbon\Carbon::parse($trx->tanggal_kembali)->format('d M Y') : '-' }}</td>
                                    <td class="px-5 py-4 text-gray-600">{{ $trx->hari_terlambat }} hari</td>
                                    <td class="px-5 py-4 text-gray-600">Rp {{ number_format($trx->denda_per_hari, 0, ',', '.') }}</td>
                                    <td class="px-5 py-4 font-semibold text-[#6C4E97]">Rp {{ number_format($trx->total_denda, 0, ',', '.') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="px-5 py-12 text-center text-gray-500">Belum ada denda keterlambatan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </div>
</x-app-layout>
