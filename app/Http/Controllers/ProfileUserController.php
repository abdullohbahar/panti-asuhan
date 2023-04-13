<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileUserController extends Controller
{

    public function index()
    {
        $data = [
            'active' => 'profile-user',
        ];

        return view('profile-user', $data);
    }
}
