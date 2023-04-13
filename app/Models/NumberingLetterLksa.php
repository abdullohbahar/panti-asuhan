<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NumberingLetterLksa extends Model
{
    use HasFactory;

    protected $fillable = [
        'nomor',
        'tgl_keluar',
        'perihal',
        'kode',
        'file',
        'filename',
        'tujuan',
    ];
}
