<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LksaFinance extends Model
{
    use HasFactory;
    use HasUuids;

    protected $fillable = [
        'id',
        'terbilang',
        'pemasukan',
        'pengeluaran',
        'keterangan',
        'tanggal',
        'urutan',
        'transaksi',
    ];
}
