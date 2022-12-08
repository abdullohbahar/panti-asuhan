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
        'donation_type_id',
        'bukti_sumbangan_id',
        'nominal',
        'keterangan',
        'tanggal_sumbangan',
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
