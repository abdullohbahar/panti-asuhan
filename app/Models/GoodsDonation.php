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
        'no',
        'keterangan',
        'hajat',
        'tanggal_donasi',
    ];

    public function donatur()
    {
        return $this->belongsTo(Donatur::class);
    }
}
