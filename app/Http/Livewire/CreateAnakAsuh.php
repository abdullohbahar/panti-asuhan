<?php

namespace App\Http\Livewire;

use App\Models\AnakAsuh;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateAnakAsuh extends Component
{
    use WithFileUploads;
    public $tgl_masuk, $tgl_keluar, $foto, $nama_lengkap, $jenis_kelamin, $tempat_lahir, $tanggal_lahir, $alamat, $tipe, $status, $pendidikan, $nama_ayah_kandung, $nama_ibu_kandung, $nohp_ortu, $idAnak, $pemilik_nohp;

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

    public function messages()
    {
        return [
            'nama_lengkap.required' => 'Nama harus diisi',
            'jenis_kelamin.required' => 'Jenis kelamin harus diisi',
            'status.required' => 'Status harus diisi',
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
            'tipe' => $this->tipe,
            'foto' => $fotoAnak,
            'pendidikan' => $this->pendidikan,
            'nama_ayah_kandung' => $this->nama_ayah_kandung,
            'nama_ibu_kandung' => $this->nama_ibu_kandung,
            'nohp_ortu' => $this->nohp_ortu,
            'pemilik_nohp' => $this->pemilik_nohp,
            'tgl_masuk' => $this->tgl_masuk,
            'tgl_keluar' => $this->tgl_keluar,
        ]);

        return redirect()->to('anak-asuh')->with('message', 'Data anak asuh berhasil ditambahkan');
    }
}
