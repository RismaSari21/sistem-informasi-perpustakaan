<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Anggota;       // ganti sesuai nama model anggota kamu
use App\Models\Peminjaman;    // ganti sesuai nama model peminjaman kamu
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // ====== STAT CARDS ======
        $totalBuku       = Book::count();
        $totalAnggota    = Anggota::count();

        // Buku baru ditambahkan bulan ini
        $bukuBaruBulanIni = Book::whereMonth('created_at', now()->month)
                                 ->whereYear('created_at', now()->year)
                                 ->count();

        // Asumsi: tabel peminjaman punya kolom tanggal_pinjam & tanggal_kembali (nullable)
        // tanggal_kembali masih NULL artinya buku itu SEDANG dipinjam / belum kembali
        $dipinjam = Peminjaman::whereNull('tanggal_kembali')->count();

        $dikembalikan = Peminjaman::whereNotNull('tanggal_kembali')
                                   ->whereMonth('tanggal_kembali', now()->month)
                                   ->whereYear('tanggal_kembali', now()->year)
                                   ->count();

        // ====== KOLEKSI PER KATEGORI (persentase ASLI dari jumlah buku per kategori) ======
        $totalKategori = Book::whereNotNull('kategori')->count();

        $categoryStats = Book::select('kategori', DB::raw('count(*) as jumlah'))
            ->whereNotNull('kategori')
            ->groupBy('kategori')
            ->orderByDesc('jumlah')
            ->take(5)
            ->get()
            ->map(function ($row) use ($totalKategori) {
                return [
                    'label'      => $row->kategori,
                    'percentage' => $totalKategori > 0
                        ? round(($row->jumlah / $totalKategori) * 100)
                        : 0,
                ];
            });

        // ====== BUKU TERLARIS (berdasarkan jumlah peminjaman ASLI) ======
        // Asumsi: model Book punya relasi hasMany ke Peminjaman, contoh:
        //   public function peminjaman() { return $this->hasMany(Peminjaman::class); }
        $popularBooks = Book::withCount('peminjaman')
            ->orderByDesc('peminjaman_count')
            ->take(4)
            ->get();

        // ====== AKTIVITAS TERBARU (gabungan beberapa sumber, urut waktu terbaru) ======
        $recentActivities = collect()
            ->merge(
                Book::latest()->take(3)->get()->map(fn ($b) => [
                    'type'  => 'buku_baru',
                    'label' => 'Buku baru ditambahkan: ' . $b->judul,
                    'sort'  => $b->created_at,
                    'time'  => $b->created_at->diffForHumans(),
                ])
            )
            ->merge(
                Peminjaman::with('book')->latest('tanggal_pinjam')->take(3)->get()->map(fn ($p) => [
                    'type'  => 'peminjaman',
                    'label' => 'Peminjaman: ' . optional($p->book)->judul,
                    'sort'  => $p->tanggal_pinjam,
                    'time'  => \Carbon\Carbon::parse($p->tanggal_pinjam)->diffForHumans(),
                ])
            )
            ->merge(
                Peminjaman::with('book')->whereNotNull('tanggal_kembali')
                    ->latest('tanggal_kembali')->take(3)->get()->map(fn ($p) => [
                        'type'  => 'pengembalian',
                        'label' => 'Buku dikembalikan: ' . optional($p->book)->judul,
                        'sort'  => $p->tanggal_kembali,
                        'time'  => \Carbon\Carbon::parse($p->tanggal_kembali)->diffForHumans(),
                    ])
            )
            ->sortByDesc('sort')
            ->take(4)
            ->values();

        // ====== KOLEKSI TERBARU (untuk grid "Koleksi Buku") ======
        $recentBooks = Book::latest()->take(4)->get();

        return view('dashboard', compact(
            'totalBuku',
            'totalAnggota',
            'bukuBaruBulanIni',
            'dipinjam',
            'dikembalikan',
            'categoryStats',
            'popularBooks',
            'recentActivities',
            'recentBooks'
        ));
    }
}