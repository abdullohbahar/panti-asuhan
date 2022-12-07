<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use App\Models\Donatur;
use Illuminate\Http\Request;

class DonationController extends Controller
{
    public function index()
    {
        // $donaturs = Donatur::get();

        $data = [
            'active' => 'donasi',
            // 'donaturs' => $donaturs
        ];

        return view('donation', $data);
    }
}
