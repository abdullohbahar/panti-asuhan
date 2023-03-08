<?php

namespace App\Http\Livewire;

use App\Models\Citizen;
use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class CreateCitizen extends Component
{
    public $nama_lengkap, $jenis_kelamin, $tempat_lahir, $tanggal_lahir, $alamat, $status, $no_hp;

    public function render()
    {
        return view('livewire.create-citizen');
    }

    public function rules()
    {
        return [
            'nama_lengkap' => 'required',
            'jenis_kelamin' => 'required',
            'tempat_lahir' => 'required',
            'alamat' => 'required',
            'status' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'nama_lengkap.required' => 'Nama harus diisi',
            'jenis_kelamin.required' => 'Jenis kelamin harus diisi',
            'status.required' => 'Status harus diisi',
            'alamat.required' => 'alamat harus diisi',
            'tempat_lahir.required' => 'tempat lahir harus diisi',
        ];
    }

    public function updated($fields)
    {
        return $this->validateOnly($fields);
    }

    public function store()
    {
        $validateData = $this->validate();

        Citizen::create([
            'nama_lengkap' => $this->nama_lengkap,
            'jenis_kelamin' => $this->jenis_kelamin,
            'status' => $this->status,
            'tempat_lahir' => $this->tempat_lahir,
            'tanggal_lahir' => $this->tanggal_lahir,
            'alamat' => $this->alamat,
            'no_hp' => $this->no_hp
        ]);

        $role = Auth::user()->role;


        return redirect()->route('create.citizen')->with('message', 'Data warga berhasil ditambahkan');
    }
}
