<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function createUser()
    {
        $data = [
            'active' => 'create-user',
        ];

        return view('create-user', $data);
    }
}
