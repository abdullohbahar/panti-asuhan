<?php

namespace App\Http\Livewire;

use App\Models\AnakAsuh;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateAnakAsuh extends Component
{
    use WithFileUploads;
    public $foto, $nama_lengkap, $jenis_kelamin, $tempat_lahir, $tanggal_lahir, $alamat, $keterangan, $status, $akta, $kartu_keluarga, $nama_ayah_kandung, $nama_ibu_kandung, $nohp_ortu, $idAnak;

    public function render()
    {
        return view('livewire.create-anak-asuh');
    }

    public function rules()
    {
        return [
            'nama_lengkap' => 'required',
            'jenis_kelamin' => 'required',
            'status' => 'required',
        ];
    }

    public function updated($fields)
    {
        return $this->validateOnly($fields);
    }

    public function store()
    {
        $validateData = $this->validate();

        if ($this->foto) {
            $fotoAnak = $this->foto->store('foto-anak', 'public');
        } else {
            $fotoAnak = null;
        }

        $this->tanggal_lahir = Carbon::parse($this->tanggal_lahir)->format('d-m-Y');

        AnakAsuh::create([
            'nama_lengkap' => $this->nama_lengkap,
            'jenis_kelamin' => $this->jenis_kelamin,
            'status' => $this->status,
            'tempat_lahir' => $this->tempat_lahir,
            'tanggal_lahir' => $this->tanggal_lahir,
            'alamat' => $this->alamat,
            'keterangan' => $this->keterangan,
            'foto' => $fotoAnak,
            'nama_ayah_kandung' => $this->nama_ayah_kandung,
            'nama_ibu_kandung' => $this->nama_ibu_kandung,
            'nohp_ortu' => $this->nohp_ortu,
        ]);

        return redirect()->to('anak-asuh')->with('message', 'Data anak asuh berhasil ditambahkan');
    }
}
