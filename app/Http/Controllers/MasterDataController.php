<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MasterDataController extends Controller
{
    public function pendidikan()
    {
        $data = [
            'active' => 'master-data-pendidikan'
        ];

        return view('master-data-pendidikan', $data);
    }

    public function position()
    {
        $data = [
            'active' => 'master-data-position'
        ];

        return view('master-data-positions', $data);
    }
}
