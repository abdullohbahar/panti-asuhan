<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use App\Models\Donatur;
use Illuminate\Http\Request;

class DonationController extends Controller
{
    public function index()
    {
        $data = [
            'active' => 'donasi',
        ];

        return view('donation', $data);
    }

    public function proofOfDonation($id)
    {
        $data = [
            'active' => 'donasi',
            'id' => $id
        ];

        return view('proof-of-donation', $data);
    }
}
