<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnakAsuh extends Model
{
    use HasFactory;
    use HasUuids;

    protected $fillable = [
        'foto',
        'nama_lengkap',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'alamat',
        'keterangan',
        'status',
        'pendidikan',
        'nama_ayah_kandung',
        'nama_ibu_kandung',
        'nohp_ortu'
    ];

    public function documents()
    {
        return $this->hasMany(ChildDocument::class);
    }
}
