<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengurus extends Model
{
    use HasFactory;
    use HasUuids;

    protected $fillable = [
        'nik',
        'nama',
        'alamat',
        'no_hp',
        'tempat_lahir',
        'tanggal_lahir',
        'jabatan',
        'foto',
        'jenis_kelamin',
        'pendidikan',
        'pekerjaan',
        'from',
        'to',
        'order',
        'status',
    ];

    public function documents()
    {
        return $this->hasMany(DocumentPengurus::class);
    }
}
