<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GoodsDonation extends Model
{
    use HasFactory;
    use HasUuids;

    protected $fillable = [
        'donatur_id',
        'keterangan',
        'hajat',
        'tanggal_donasi',
        'penerima',
    ];

    public function donatur()
    {
        return $this->belongsTo(Donatur::class);
    }

    public function number()
    {
        return $this->hasOne(ProofOfDonationNumber::class, 'donation_id', 'id');
    }

    public function details()
    {
        return $this->hasMany(DetailGoodsDonation::class, 'goods_donations_id', 'id')->select('nama_barang', 'jumlah');
    }

    public function detail()
    {
        return $this->hasMany(DetailGoodsDonation::class, 'goods_donations_id', 'id');
    }
}
