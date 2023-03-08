<?php

namespace App\Http\Controllers;

use App\Models\Donatur;
use Illuminate\Http\Request;

class DonaturController extends Controller
{
    public function index()
    {
        $data = [
            'active' => 'donatur'
        ];

        return view('donatur', $data);
    }

    public function exportDonaturPdf()
    {
        $data = [
            'active' => 'donatur',
            'donaturs' => Donatur::get()
        ];

        return view('export.export-donatur-pdf', $data);
    }
}
