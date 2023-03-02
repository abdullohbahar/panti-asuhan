<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CitizenDocument extends Model
{
    use HasFactory;

    protected $fillable = [
        'citizen_id',
        'nama_dokumen',
        'file'
    ];
}
