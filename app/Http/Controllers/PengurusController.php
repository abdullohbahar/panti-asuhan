<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PengurusController extends Controller
{
    public function index()
    {
        $data = [
            'active' => 'pengurus'
        ];

        return view('pengurus', $data);
    }

    public function create()
    {
        $data = [
            'active' => 'pengurus'
        ];
        return view('create-pengurus', $data);
    }
}
