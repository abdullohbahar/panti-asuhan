<?php

namespace App\Http\Livewire;

use App\Models\AnakAsuh;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditAnakAsuh extends Component
{
    public $idanak, $nama_lengkap, $jenis_kelamin, $tempat_lahir, $tanggal_lahir, $alamat, $keterangan, $status, $akta, $kartu_keluarga, $nama_ayah_kandung, $nama_ibu_kandung, $nohp_ortu, $foto;
    use WithFileUploads;


    public function mount()
    {
        $anak = AnakAsuh::findorfail($this->idanak);

        $this->nama_lengkap = $anak->nama_lengkap;
        $this->jenis_kelamin = $anak->jenis_kelamin;
        $this->tempat_lahir = $anak->tempat_lahir;
        $this->tanggal_lahir = Carbon::parse($anak->tanggal_lahir)->format('Y-m-d');
        $this->alamat = $anak->alamat;
        $this->keterangan = $anak->keterangan;
        $this->status = $anak->status;
        $this->nama_ayah_kandung = $anak->nama_ayah_kandung;
        $this->nama_ibu_kandung = $anak->nama_ibu_kandung;
        $this->nohp_ortu = $anak->nohp_ortu;
    }

    public function render()
    {
        $anak = AnakAsuh::findorfail($this->idanak);

        $data = [
            'anak' => $anak
        ];

        return view('livewire.edit-anak-asuh', $data);
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
            'nama_lengkap.required' => 'Nominal harus diisi'
        ];
    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function update()
    {
        $this->validate();

        $anak = AnakAsuh::findorfail($this->idanak);


        if ($this->foto) {
            $fotoAnak = $this->foto->store('foto-anak', 'public');
        } else {
            $fotoAnak = $anak->foto;
        }

        if ($this->akta) {
            $akta = $this->akta->store('akta', 'public');
        } else {
            $akta = $anak->akta;
        }

        if ($this->kartu_keluarga) {
            $kk = $this->kartu_keluarga->store('kartu-keluarga', 'public');
        } else {
            $kk = $anak->kartu_keluarga;
        }

        AnakAsuh::where('id', $this->idanak)->update([
            'nama_lengkap' => $this->nama_lengkap,
            'jenis_kelamin' => $this->jenis_kelamin,
            'status' => $this->status,
            'tempat_lahir' => $this->tempat_lahir,
            'tanggal_lahir' => $this->tanggal_lahir,
            'alamat' => $this->alamat,
            'keterangan' => $this->keterangan,
            'foto' => $fotoAnak,
            'akta' => $akta,
            'kartu_keluarga' => $kk,
            'nama_ayah_kandung' => $this->nama_ayah_kandung,
            'nama_ibu_kandung' => $this->nama_ibu_kandung,
            'nohp_ortu' => $this->nohp_ortu,
        ]);

        return redirect()->to('anak-asuh')->with('message', 'Data anak asuh berhasil diubah');
    }
}
