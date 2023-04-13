<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LetterYayasan extends Model
{
    use HasFactory;

    protected $fillable = [
        'file',
        'nama_pengirim',
        'nomor_surat',
        'perihal_surat',
        'tanggal',
        'isi_surat',
        'tipe',
        'tanggal_diterima',
        'disposisi_penugasan',
        'file_dokumentasi',
    ];
}
