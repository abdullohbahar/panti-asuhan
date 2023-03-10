<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class YayasanDocument extends Model
{
    use HasFactory;

    use HasUuids;

    protected $fillable = [
        'id',
        'name',
        'file',
    ];
}