<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function unit()
    {
        $data = [
            'active' => 'satuan'
        ];
        return view('unit', $data);
    }
}
