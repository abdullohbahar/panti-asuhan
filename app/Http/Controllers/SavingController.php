<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
}
