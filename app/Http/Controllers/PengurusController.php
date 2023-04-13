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
            'active' => 'create-pengurus'
        ];
        return view('create-pengurus', $data);
    }

    public function show($id)
    {
        $data = [
            'id' => $id,
            'active' => 'show'
        ];
        return view('profil-pengurus', $data);
    }

    public function edit($id)
    {
        $data = [
            'id' => $id,
            'active' => 'show'
        ];
        return view('edit-pengurus', $data);
    }
}
