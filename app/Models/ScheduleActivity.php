<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScheduleActivity extends Model
{
    use HasFactory;
    use HasUuids;

    protected $fillable = [
        'tanggal',
        'acara',
        'pengundang',
        'nomor_hp_pengundang',
        'keterangan'
    ];
}
