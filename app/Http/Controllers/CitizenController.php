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
