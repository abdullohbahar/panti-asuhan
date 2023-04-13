<?php

namespace App\Http\Livewire;

use Exception;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class ProfileUser extends Component
{
    public $username;
    public $role;
    public $password;
    public $idUser;

    public function mount()
    {
        $this->username = Auth::user()->username;
        $this->role = Auth::user()->role;
        $this->idUser = Auth::user()->id;
    }

    public function render()
    {
        return view('livewire.profile-user');
    }

    public function rules()
    {
        return [
            'username' => 'required|unique:users,username'
        ];
    }

    public function messages()
    {
        return [
            'username.required' => 'Username harus diisi',
            'username.unique' => 'Username sudah terpakai'
        ];
    }

    public function validated($fields)
    {
        $this->validateOnly($fields);
    }

    public function update()
    {
        $data = [
            'username' => $this->username,
        ];

        try {
            DB::beginTransaction();

            if ($this->password) {
                $data['password'] = Hash::make($this->password);
            }

            User::where('id', $this->idUser)->update($data);

            DB::commit();
            $this->dispatchBrowserEvent('show-success', ['message' => 'Berhasil ubah profile']);
        } catch (Exception $e) {
            Log::debug($e);
            DB::rollBack();
            $this->dispatchBrowserEvent('show-error', ['message' => 'Error, Coba untuk input data lagi atau hubungi developer']);
        }
    }
}
