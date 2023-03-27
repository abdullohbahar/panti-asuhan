<?php

namespace App\Http\Livewire;

use App\Models\Citizen;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditCitizen extends Component
{
    public $idwarga, $nama_lengkap, $jenis_kelamin, $tempat_lahir, $tanggal_lahir, $alamat, $status, $no_hp, $nik;

    public function mount()
    {
        $anak = Citizen::findorfail($this->idwarga);

        if ($anak) {
            $this->idwarga = $anak->id;
            $this->nama_lengkap = $anak->nama_lengkap;
            $this->jenis_kelamin = $anak->jenis_kelamin;
            $this->tempat_lahir = $anak->tempat_lahir;
            $this->tanggal_lahir = Carbon::parse($anak->tanggal_lahir)->format('Y-m-d');
            $this->alamat = $anak->alamat;
            $this->status = $anak->status;
            $this->status = $anak->status;
            $this->jenis_kelamin = $anak->jenis_kelamin;
            $this->no_hp = $anak->no_hp;
            $this->nik = $anak->nik;
        }
    }

    public function render()
    {
        return view('livewire.edit-citizen');
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
        $this->validateOnly($fields);
    }

    public function update()
    {
        $this->validate();

        $citizen = Citizen::findorfail($this->idwarga);

        Citizen::where('id', $this->idwarga)->update([
            'nama_lengkap' => $this->nama_lengkap,
            'jenis_kelamin' => $this->jenis_kelamin,
            'status' => $this->status,
            'tempat_lahir' => $this->tempat_lahir,
            'tanggal_lahir' => $this->tanggal_lahir,
            'alamat' => $this->alamat,
            'no_hp' => $this->no_hp,
            'nik' => $this->nik,
        ]);

        return redirect()->to('admin-yayasan/profil-warga/' . $this->idwarga)->with('message', 'Data warga berhasil diubah');
    }
}
