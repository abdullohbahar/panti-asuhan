<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LetterYayasan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nomor_surat',
        'keterangan',
        'tipe',
        'file',
    ];
}
