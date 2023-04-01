<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LetterLksa extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_pengirim',
        'perihal_surat',
        'nomor_surat',
        'isi_surat',
        'tanggal',
        'file',
        'tipe',
    ];
}
