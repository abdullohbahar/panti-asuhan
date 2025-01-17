<?php

namespace App\Http\Livewire;

use App\Models\AnakAsuh;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditAnakAsuh extends Component
{
    public $tgl_masuk, $nik, $nis, $oldPhoto, $wali_anak, $tgl_keluar, $idanak, $nama_lengkap, $jenis_kelamin, $tempat_lahir, $tanggal_lahir, $alamat, $tipe, $status, $pendidikan, $nama_ayah_kandung, $nama_ibu_kandung, $nohp_ortu, $foto, $pemilik_nohp;
    use WithFileUploads;


    public function mount()
    {
        $anak = AnakAsuh::findorfail($this->idanak);

        if ($anak) {
            $this->idanak = $anak->id;
            $this->nama_lengkap = $anak->nama_lengkap;
            $this->jenis_kelamin = $anak->jenis_kelamin;
            $this->tempat_lahir = $anak->tempat_lahir;
            $this->tanggal_lahir = Carbon::parse($anak->tanggal_lahir)->format('Y-m-d');
            $this->alamat = $anak->alamat;
            $this->tipe = $anak->tipe;
            $this->status = $anak->status;
            $this->nama_ayah_kandung = $anak->nama_ayah_kandung;
            $this->nama_ibu_kandung = $anak->nama_ibu_kandung;
            $this->nohp_ortu = $anak->nohp_ortu;
            $this->status = $anak->status;
            $this->jenis_kelamin = $anak->jenis_kelamin;
            $this->oldPhoto = $anak->foto;
            $this->pendidikan = $anak->pendidikan;
            $this->pemilik_nohp = $anak->pemilik_nohp;
            $this->tgl_masuk = $anak->tgl_masuk;
            $this->tgl_keluar = $anak->tgl_keluar;
            $this->wali_anak = $anak->wali_anak;
            $this->nik = $anak->nik;
            $this->nis = $anak->nis;
        }
    }

    public function render()
    {
        $anakasuh = AnakAsuh::findorfail($this->idanak);

        $data = [
            'fotos' => $anakasuh->foto,
            'status' => $this->status,
            'jenis_kelamin' => $this->jenis_kelamin
        ];

        return view('livewire.edit-anak-asuh', $data);
    }

    public function rules()
    {
        $validation = [
            'nama_lengkap' => 'required',
            'jenis_kelamin' => 'required',
            'status' => 'required',
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
            'nama_lengkap.required' => 'Nama lengkap harus diisi',
            'jenis_kelamin.required' => 'Jenis kelamin harus diisi',
            'status.required' => 'Status harus diisi',
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
            if ($this->foto != $anak->foto) {
                if ($anak->foto) {
                    unlink(public_path('storage/' . $anak->foto));
                }
                $fotoAnak = $this->foto->store('foto-anak', 'public');
            } else {
                $fotoAnak = $anak->foto;
            }
        } else {
            $fotoAnak = $this->oldPhoto;
        }

        AnakAsuh::where('id', $this->idanak)->update([
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
            'wali_anak' => $this->wali_anak,
            'nik' => $this->nik,
            'nis' => $this->nis,
        ]);

        return redirect()->to('profile-anak-asuh/' . $this->idanak)->with('message', 'Data anak asuh berhasil diubah');
    }
}
