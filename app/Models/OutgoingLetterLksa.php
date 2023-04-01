<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OutgoingLetterLksa extends Model
{
    use HasFactory;

    protected $fillable = [
        'nomor_surat',
        'nomor_urutan',
        'tanggal',
        'perihal',
        'tujuan',
        'file',
        'tanggal_diterima',
        'disposisi_penugasan',
        'file_dokumentasi',
    ];
}
