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

    public function donationGoods()
    {
        $data = [
            'active' => 'donasi-barang',
        ];

        return view('donation-goods', $data);
    }

    public function proofOfDonation($id)
    {
        $data = [
            'active' => 'donasi-barang',
            'id' => $id
        ];

        return view('proof-of-donation', $data);
    }

    public function reportFunds()
    {
        $data = [
            'active' => 'penggunaan-dana',
        ];

        return view('laporan-penggunaan-dana', $data);
    }

    public function pilih()
    {
        $data = [
            'active' => 'donasi',
        ];

        return view('jenis-donasi', $data);
    }

    public function donasiTunai()
    {
        $data = [
            'active' => 'donasi',
        ];

        return view('donasi-tunai', $data);
    }

    public function pengeluaran()
    {
        $data = [
            'active' => 'pengeluaran',
        ];

        return view('pengeluaran', $data);
    }
}
