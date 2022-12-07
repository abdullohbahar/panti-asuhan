<?php

namespace App\Http\Controllers;

use App\Models\DonationType;
use Illuminate\Http\Request;

class DonationTypeController extends Controller
{
    public function index()
    {
        $data = [
            'active' => 'tipe'
        ];

        return view('donation-type', $data);
    }
}
