<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuktiSumbangan extends Model
{
    use HasFactory;
    use HasUuids;

    protected $fillable = [
        'goods_donations_id',
        'file',
        'keterangan'
    ];
}
