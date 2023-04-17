<?php

namespace App\Http\Controllers;

use App\Models\Citizen;
use App\Exports\WargaExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CitizenController extends Controller
{
    public function createCitizen()
    {
        $data = [
            'active' => 'create-citizen',
        ];

        return view('create-citizen', $data);
    }

    public function dataWargaDhuafa()
    {
        $data = [
            'active' => 'data-warga-dhuafa',
        ];

        return view('data-warga-dhuafa', $data);
    }

    public function dataWargaFakirMiskin()
    {
        $data = [
            'active' => 'data-warga-fakir-miskin',
        ];

        return view('data-warga-fakir-miskin', $data);
    }

    public function dataWargaJompo()
    {
        $data = [
            'active' => 'data-warga-jompo',
        ];

        return view('data-warga-jompo', $data);
    }

    public function dataWargaJamaah()
    {
        $data = [
            'active' => 'data-warga-jamaah',
        ];

        return view('data-warga-jamaah', $data);
    }

    public function dataWargaMeninggal()
    {
        $data = [
            'active' => 'data-warga-meninggal',
        ];

        return view('data-warga-meninggal', $data);
    }

    public function dataWargaDusun()
    {
        $data = [
            'active' => 'data-warga-dusun',
        ];

        return view('data-warga-dusun', $data);
    }

    public function profileWarga($id)
    {
        $data = [
            'id' => $id,
            'active' => ''
        ];
        return view('profil-warga', $data);
    }

    public function editCitizen($id)
    {
        $data = [
            'id' => $id,
            'active' => ''
        ];
        return view('edit-warga', $data);
    }

    public function exportWargaPdf($status)
    {
        $wargas = Citizen::where('status', $status)->get();
        $data = [
            'wargas' => $wargas,
            'status' => $status
        ];

        return view('export.export-warga-pdf', $data);
    }

    public function exportExcel()
    {
        $filename = 'Data_Warga_Dhuafa.xlsx';
        (new WargaExport('Dhuafa'))->store($filename, 'public');
        return response()->json(['url' => Storage::url($filename)]);
    }
}
