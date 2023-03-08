<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentPengurus extends Model
{
    use HasFactory;

    protected $fillable = [
        'pengurus_id',
        'nama_dokumen',
        'file'
    ];
}
