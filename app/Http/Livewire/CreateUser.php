<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;

class CreateUser extends Component
{
    public $username, $password, $role;

    public function render()
    {
        return view('livewire.create-user');
    }

    public function rules()
    {
        return [
            'username' => 'required|unique:users,username',
            'role' => 'required',
            'password' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'username.required' => 'Username harus diisi',
            'username.unique' => 'Username sudah dipakai',
            'role.required' => 'Hak akses harus diisi',
            'password.required' => 'Password harus diisi',
        ];
    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function store()
    {
        $this->validate();

        // store data
        User::create([
            'username' => $this->username,
            'role' => $this->role,
            'password' => Hash::make($this->password),
            'foto' => 'default.jpg',
        ]);

        return redirect()->route('data.pengguna')->with('message', 'Pengguna berhasil ditambahkan');
    }
}
