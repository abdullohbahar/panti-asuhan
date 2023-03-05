<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
}
