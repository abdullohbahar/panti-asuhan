<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProofOfDonationNumber extends Model
{
    use HasFactory;

    protected $fillable = [
        'donation_id',
        'name',
        'no',
    ];
}
