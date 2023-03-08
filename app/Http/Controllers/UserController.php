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

    public function dataUser()
    {
        $data = [
            'active' => 'data-user',
        ];

        return view('data-user', $data);
    }

    public function editUser($id)
    {
        $data = [
            'active' => 'edit-user',
            'id' => $id,
        ];

        return view('edit-user', $data);
    }
}
