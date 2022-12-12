<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Saving extends Model
{
    use HasFactory;
    use HasUuids;

    protected $fillable = [
        'anak_asuh_id',
        'nominal',
        'tanggal_menabung',
        'keterangan'
    ];
}
