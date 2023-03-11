<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KeuanganLksaController extends Controller
{
    public function pemasukan()
    {
        $data = [
            'active' => 'income-lksa'
        ];

        return view('income-lksa', $data);
    }

    public function dataPemasukan()
    {
        $data = [
            'active' => 'data-income-lksa'
        ];

        return view('data-income-lksa', $data);
    }
}
