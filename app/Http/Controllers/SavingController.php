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
}
