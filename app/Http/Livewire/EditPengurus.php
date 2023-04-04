<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\Pengurus;
use Livewire\WithFileUploads;
use App\Models\MasterDataPosition;
use App\Models\MasterDataPendidikan;

class EditPengurus extends Component
{
    public $idpengurus, $to, $from, $status, $oldPhoto, $nama, $jenis_kelamin, $tempat_lahir, $tanggal_lahir, $alamat, $no_hp, $foto, $jabatan, $pendidikan, $pekerjaan, $nik, $masa_bakti;
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
            $this->jabatan = $pengurus->jabatan;
            $this->pendidikan = $pengurus->pendidikan;
            $this->pekerjaan = $pengurus->pekerjaan;
            $this->nik = $pengurus->nik;
            $this->oldPhoto = $pengurus->foto;
            $this->status = $pengurus->status;
            $this->from = $pengurus->from;
            $this->to = $pengurus->to;
        }
    }

    public function render()
    {
        $pendidikans = MasterDataPendidikan::get();
        $positions = MasterDataPosition::get();

        $pengurus = Pengurus::findorfail($this->idpengurus);

        $data = [
            'pendidikans' => $pendidikans,
            'fotos' => $pengurus->foto,
            'positions' => $positions,
        ];

        return view('livewire.edit-pengurus', $data);
    }

    public function rules()
    {
        $validation = [
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'jabatan' => 'required',
            'alamat' => 'required',
            'status' => 'required',
            'from' => 'required',
            'to' => 'required',
        ];

        if ($this->foto) {
            $validation['foto'] = 'image|max:2048';
        }

        return $validation;
    }

    public function messages()
    {
        return [
            'foto.image' => 'Foto harus berupa JPG atau PNG',
            'foto.max' => 'Foto max 2 MB',
            'nama.required' => 'Nama harus diisi',
            'jenis_kelamin.required' => 'Jenis kelamin harus diisi',
            'tempat_lahir.required' => 'Tempat lahir harus diisi',
            'tanggal_lahir.required' => 'Tanggal lahir harus diisi',
            'jabatan.required' => 'Jabatan harus diisi',
            'alamat.required' => 'Alamat harus diisi',
            'status.required' => 'Status harus diisi',
            'from.required' => 'Harus diisi',
            'to.required' => 'Harus diisi',
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

        // dd($anak->foto);

        if ($this->foto) {
            if ($this->foto != $anak->foto) {
                if ($anak->foto) {
                    unlink(public_path('storage/' . $anak->foto));
                }
                $fotoPengurus = $this->foto->store('foto-pengurus', 'public');
            } else {
                $fotoPengurus = $anak->foto;
            }
        } else {
            $fotoPengurus = $this->oldPhoto;
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
            'pendidikan' => $this->pendidikan,
            'pekerjaan' => $this->pekerjaan,
            'nik' => $this->nik,
            'from' => $this->from,
            'to' => $this->to,
            'status' => $this->status,
        ]);

        return redirect()->to('profile-pengurus/' . $this->idpengurus)->with('message', 'Data pengurus berhasil diubah');
    }
}
