<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AnakAsuhController extends Controller
{
    public function index()
    {
        $data = [
            'active' => 'anak-asuh'
        ];

        return view('anak-asuh', $data);
    }

    public function create()
    {
        $data = [
            'active' => 'anak-asuh'
        ];

        return view('create-anak-asuh', $data);
    }
}
