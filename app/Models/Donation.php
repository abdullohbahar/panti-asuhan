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
        'norek',
        'bank',
        'penerima',
        'nomor_transaksi',
    ];

    public function donatur()
    {
        return $this->belongsTo(Donatur::class);
    }

    public function bukti_sumbangan()
    {
        return $this->hasMany(BuktiSumbangan::class);
    }

    public function number()
    {
        return $this->hasOne(ProofOfDonationNumber::class);
    }

    public function donaturName()
    {
        return $this->hasOne(Donatur::class, 'id', 'donatur_id');
    }
}
