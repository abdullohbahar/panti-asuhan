<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DocumentController extends Controller
{
    public function lksa()
    {
        $data = [
            'active' => 'lksa-document'
        ];

        return view('lksa-document', $data);
    }
}
