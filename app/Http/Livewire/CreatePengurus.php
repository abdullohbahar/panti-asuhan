<?php

namespace App\Http\Livewire;

use App\Models\Pengurus;
use Livewire\Component;
use Livewire\WithFileUploads;
use Carbon\Carbon;


class CreatePengurus extends Component
{
    public $foto, $nama, $no_hp, $jenis_kelamin, $tempat_lahir, $tanggal_lahir, $jabatan, $alamat;
    use WithFileUploads;

    public function render()
    {
        return view('livewire.create-pengurus');
    }

    public function rules()
    {
        return [
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'jabatan' => 'required',
            'alamat' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'nama.required' => 'Nama harus diisi',
            'jenis_kelamin.required' => 'Jenis kelamin harus diisi',
            'tempat_lahir.required' => 'Tempat lahir harus diisi',
            'tanggal_lahir.required' => 'Tanggal lahir harus diisi',
            'jabatan.required' => 'Jabatan harus diisi',
            'alamat.required' => 'Alamat harus diisi',
        ];
    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function store()
    {
        $this->validate();

        if ($this->foto) {
            $fotoPengurus = $this->foto->store('foto-pengurus', 'public');
        } else {
            $fotoPengurus = null;
        }

        $this->tanggal_lahir = Carbon::parse($this->tanggal_lahir)->format('d-m-Y');

        Pengurus::create([
            'nama' => $this->nama,
            'jenis_kelamin' => $this->jenis_kelamin,
            'tempat_lahir' => $this->tempat_lahir,
            'tanggal_lahir' => $this->tanggal_lahir,
            'alamat' => $this->alamat,
            'jabatan' => $this->jabatan,
            'foto' => $fotoPengurus,
            'no_hp' => $this->no_hp,
        ]);

        return redirect()->to('pengurus')->with('message', 'Data pengurus berhasil ditambahkan');
    }
}
