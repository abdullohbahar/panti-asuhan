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
}
