<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\Pengurus;
use Livewire\WithFileUploads;

class EditPengurus extends Component
{
    public $idpengurus, $nama, $jenis_kelamin, $tempat_lahir, $tanggal_lahir, $alamat, $no_hp, $foto, $jabatan;
    use WithFileUploads;

    public function mount()
    {
        $pengurus = Pengurus::findorfail($this->idpengurus);

        if ($pengurus) {
            $this->idpengurus = $pengurus->id;
            $this->nama = $pengurus->nama;
            $this->jenis_kelamin = $pengurus->jenis_kelamin;
            $this->tempat_lahir = $pengurus->tempat_lahir;
            $this->tanggal_lahir = Carbon::parse($pengurus->tanggal_lahir)->format('Y-m-d');
            $this->alamat = $pengurus->alamat;
            $this->no_hp = $pengurus->no_hp;
            $this->foto = $pengurus->foto;
            $this->jabatan = $pengurus->jabatan;
        }
    }

    public function render()
    {
        return view('livewire.edit-pengurus');
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

    public function update()
    {
        $this->validate();

        $anak = Pengurus::findorfail($this->idpengurus);

        if ($this->foto != $anak->foto) {
            unlink(public_path('storage/' . $anak->foto));
            $fotoPengurus = $this->foto->store('foto-pengurus', 'public');
        } else {
            $fotoPengurus = $anak->foto;
        }

        Pengurus::where('id', $this->idpengurus)->update([
            'nama' => $this->nama,
            'jenis_kelamin' => $this->jenis_kelamin,
            'tempat_lahir' => $this->tempat_lahir,
            'tanggal_lahir' => $this->tanggal_lahir,
            'alamat' => $this->alamat,
            'jabatan' => $this->jabatan,
            'foto' => $fotoPengurus,
            'no_hp' => $this->no_hp,
        ]);

        return redirect()->to('profile-pengurus/' . $this->idpengurus)->with('message', 'Data pengurus berhasil diubah');
    }
}