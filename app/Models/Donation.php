<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    use HasFactory;
    use HasUuids;

    protected $fillable = [
        'donatur_id',
        'jenis_donasi',
        'terbilang',
        'pemasukan',
        'pengeluaran',
        'saldo',
        'keterangan',
        'tipe',
        'tanggal_donasi',
        'urutan',
        'transaksi',
        'no',
        'norek',
        'bank'
    ];

    public function donatur()
    {
        return $this->belongsTo(Donatur::class);
    }

    public function bukti_sumbangan()
    {
        return $this->hasMany(BuktiSumbangan::class);
    }
}
