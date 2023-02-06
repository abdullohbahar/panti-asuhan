<?php

namespace App\Http\Controllers;

use App\Models\AnakAsuh;
use Illuminate\Http\Request;

class AnakAsuhController extends Controller
{
    public function index()
    {
        $data = [
            'active' => 'santri-dalam'
        ];

        return view('anak-asuh', $data);
    }

    public function create()
    {
        $data = [
            'active' => 'create-santri'
        ];

        return view('create-anak-asuh', $data);
    }

    public function show($id)
    {

        $data = [
            'active' => 'anak-asuh',
            'id' => $id,
        ];

        return view('edit-anak-asuh', $data);
    }

    public function childDocument($id)
    {
        $data = [
            'active' => 'anak-asuh',
            'id' => $id,
        ];

        return view('child-document', $data);
    }

    public function profileAnak($id)
    {
        $data = [
            'active' => 'anak-asuh',
            'id' => $id,
        ];

        return view('profil-anak', $data);
    }

    public function santriLuar()
    {
        $data = [
            'active' => 'santri-luar',
        ];

        return view('data-santri-luar', $data);
    }
}
