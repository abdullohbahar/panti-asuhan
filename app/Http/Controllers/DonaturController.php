<?php

namespace App\Http\Controllers;

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
}
