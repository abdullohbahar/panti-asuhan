<?php

namespace App\Http\Controllers;

use App\Models\AnakAsuh;
use PDF;
use Illuminate\Http\Request;
use App\Models\SavingHistory;

class SavingController extends Controller
{
    public function index()
    {
        $data = [
            'active' => 'tabungan'
        ];

        return view('saving', $data);
    }

    public function show($id)
    {
        $data = [
            'active' => 'tabungan',
            'id' => $id
        ];

        return view('saving-history', $data);
    }

    public function print($id)
    {
        $query = SavingHistory::where('saving_id', $id)->get();

        $anakAsuh = AnakAsuh::where('id', $query[0]->anak_asuh_id)->get();

        $data = [
            'datas' => $query
        ];

        // return view('cetak-tabungan-anak-asuh', $data);

        $pdf = PDF::loadView('cetak-tabungan-anak-asuh', $data);

        return $pdf->download(date('d-m-Y') . ' - Tabungan - ' . $anakAsuh[0]->nama_lengkap . '.pdf');
    }
}
