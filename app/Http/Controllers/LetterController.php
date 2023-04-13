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

    public function dataOutcomeLetterYayasan()
    {
        $data = [
            'active' => 'data-outcome-letter-yayasan'
        ];

        return view('data-outcome-letter-yayasan', $data);
    }

    public function createLetterLksa()
    {

        $data = [
            'active' => 'create-letter-lksa'
        ];

        return view('create-letter-lksa', $data);
    }

    public function dataIncomingLetterLksa()
    {
        $data = [
            'active' => 'data-letter-lksa'
        ];

        return view('data-income-letter-lksa', $data);
    }

    public function dataOutcomeLetterLksa()
    {
        $data = [
            'active' => 'data-outcome-letter-lksa'
        ];

        return view('data-outcome-letter-lksa', $data);
    }
}
