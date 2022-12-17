<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SavingHistory extends Model
{
    use HasFactory;
    use HasUuids;

    protected $fillable = [
        'anak_asuh_id',
        'saving_id',
        'tanggal',
        'mengambil',
        'menabung',
        'saldo',
    ];
}
