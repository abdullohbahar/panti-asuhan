<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;

class EditUser extends Component
{
    public $iduser, $username, $role, $password;

    public function mount()
    {
        $user = User::findorfail($this->iduser);

        if ($user) {
            $this->username = $user->username;
            $this->role = $user->role;
        }
    }

    public function render()
    {
        return view('livewire.edit-user');
    }

    public function rules()
    {
        return [
            'username' => 'required',
            'role' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'username.required' => 'Username harus diisi',
            'role.required' => 'Hak akses harus diisi',
        ];
    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function update()
    {
        $this->validate();


        $data = [
            'username' => $this->username,
            'role' => $this->role,
        ];

        if (!empty($this->password)) {
            $data['password'] = Hash::make($this->password);
        }

        // store data
        User::where('id', $this->iduser)->update($data);

        return redirect()->route('data.pengguna.admin.yayasan')->with('message', 'Pengguna berhasil diubah');
    }
}
