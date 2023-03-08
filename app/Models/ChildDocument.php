<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChildDocument extends Model
{
    use HasFactory;

    protected $fillable = [
        'anak_asuh_id',
        'nama_dokumen',
        'file'
    ];
}
