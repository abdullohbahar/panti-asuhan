<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Livewire\WithFileUploads;

class LetterController extends Controller
{
    public function createLetterYayasan()
    {

        $data = [
            'active' => 'create-letter-yayasan'
        ];

        return view('create-letter-yayasan', $data);
    }

    public function dataIncomingLetterYayasan()
    {
        $data = [
            'active' => 'data-letter-yayasan'
        ];

        return view('data-incoming-letter-yayasan', $data);
    }
}
