<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            $request->session()->regenerate();

            switch (Auth::user()->role) {
                case 'admin-yayasan':
                    return redirect()->route('dashboard.admin.yayasan');
                    break;
                case 'admin-donasi':
                    return redirect()->route('dashboard.admin.donasi');
                    break;
                case 'bendahara-lksa':
                    return redirect()->route('dashboard.bendahara.lksa');
                    break;
                case 'bendahara-yayasan':
                    return redirect()->route('dashboard.bendahara.yayasan');
                    break;
                case 'ketua-lksa':
                    return redirect()->route('dashboard.ketua.lksa');
                    break;
                case 'ketua-yayasan':
                    return redirect()->route('dashboard.ketua.yayasan');
                    break;
                case 'pembina-yayasan':
                    return redirect()->route('dashboard.pembina.yayasan');
                    break;
                case 'sekretariat-yayasan':
                    return redirect()->route('dashboard.sekretariat.yayasan');
                    break;
                case 'sekretariat-lksa':
                    return redirect()->route('dashboard.sekretariat.lksa');
                    break;
                default:
                    return redirect()->to('login');
            }
        }

        session()->flash('message', 'Username atau password salah');
        return redirect()->to('/');
    }
}
