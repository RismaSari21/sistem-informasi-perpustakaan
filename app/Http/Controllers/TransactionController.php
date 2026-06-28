<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Member;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        $members = Member::latest()->get();
        $books = Book::latest()->get();
        $transactions = Transaction::with(['book', 'member'])->where('status', 'dipinjam')->latest()->get();
        $returnedTransactions = Transaction::with(['book', 'member'])->where('status', 'dikembalikan')->latest()->get();

        return view('transactions.index', compact('members', 'books', 'transactions', 'returnedTransactions'));
    }

    public function createMember()
    {
        return view('transactions.create_member');
    }

    public function storeMember(Request $request)
    {
        $request->validate([
            'nomor_anggota' => 'required|unique:members,nomor_anggota',
            'nama' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:L,P',
            'telepon' => 'required',
            'alamat' => 'required',
        ]);

        Member::create($request->all());

        return redirect()->route('transactions.index')->with('success', 'Anggota baru berhasil didaftarkan!');
    }

    public function createPeminjaman()
    {
        $members = Member::all();
        $books = Book::all();

        return view('transactions.create_peminjaman', compact('members', 'books'));
    }

    public function storePeminjaman(Request $request)
    {
        $request->validate([
            'kode_transaksi' => 'required|unique:transactions,kode_transaksi',
            'member_id' => 'required|exists:members,id',
            'book_id' => 'required|exists:books,id',
            'tanggal_pinjam' => 'required|date',
            'jatuh_tempo' => 'required|date|after_or_equal:tanggal_pinjam',
            'denda_per_hari' => 'required|integer|min:0',
        ]);

        $book = Book::findOrFail($request->book_id);

        if ($book->stok < 1) {
            return back()->withErrors(['book_id' => 'Maaf, stok buku ini sedang habis!']);
        }

        Transaction::create([
            'kode_transaksi' => $request->kode_transaksi,
            'member_id' => $request->member_id,
            'book_id' => $request->book_id,
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'jatuh_tempo' => $request->jatuh_tempo,
            'denda_per_hari' => $request->denda_per_hari,
            'hari_terlambat' => 0,
            'total_denda' => 0,
            'status' => 'dipinjam',
        ]);

        $book->decrement('stok');

        return redirect()->route('transactions.index')->with('success', 'Transaksi peminjaman berhasil dicatat! Stok buku berkurang.');
    }

    public function returnBuku($id)
    {
        $transaction = Transaction::findOrFail($id);

        if ($transaction->status == 'dikembalikan') {
            return back()->with('success', 'Buku ini sudah dikembalikan sebelumnya.');
        }

        $tanggalKembali = Carbon::today();
        $jatuhTempo = $transaction->jatuh_tempo ? Carbon::parse($transaction->jatuh_tempo) : Carbon::parse($transaction->tanggal_pinjam);
        $hariTerlambat = $tanggalKembali->gt($jatuhTempo) ? $jatuhTempo->diffInDays($tanggalKembali) : 0;
        $totalDenda = $hariTerlambat * (int) $transaction->denda_per_hari;

        $transaction->update([
            'tanggal_kembali' => $tanggalKembali->toDateString(),
            'hari_terlambat' => $hariTerlambat,
            'total_denda' => $totalDenda,
            'status' => 'dikembalikan',
        ]);

        $transaction->book()->increment('stok');

        return redirect()->route('transactions.index')->with('success', $totalDenda > 0
            ? 'Buku berhasil dikembalikan dan denda sudah dihitung.'
            : 'Buku berhasil dikembalikan! Tidak ada denda keterlambatan.');
    }

    public function denda()
    {
        $transactions = Transaction::with(['book', 'member'])
            ->where('total_denda', '>', 0)
            ->latest('tanggal_kembali')
            ->get();

        $totalDenda = $transactions->sum('total_denda');

        return view('transactions.denda', compact('transactions', 'totalDenda'));
    }
}