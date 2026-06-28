<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    protected $fillable = [
        'kode_transaksi',
        'member_id',
        'book_id',
        'tanggal_pinjam',
        'jatuh_tempo',
        'tanggal_kembali',
        'denda_per_hari',
        'hari_terlambat',
        'total_denda',
        'status',
    ];

    public function member(): BelongsTo
    {
        return $this->belongsTo(Member::class);
    }

    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }
}