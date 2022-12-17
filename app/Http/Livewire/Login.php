<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Livewire\Component;

class Login extends Component
{
    public $username, $password;

    public function render()
    {
        return view('livewire.login');
    }

    public function rules()
    {
        return [
            'username' => 'required',
            'password' => 'required'
        ];
    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function store(Request $request)
    {
        $validateData = $this->validate();

        if (Auth::attempt($validateData)) {

            return redirect()->intended('dashboard');
        }

        session()->flash('message', 'Username atau password salah');
        return redirect()->to('/');
    }
}
