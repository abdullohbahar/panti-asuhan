<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\AnakAsuh;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class CreateAnakAsuh extends Component
{
    use WithFileUploads;
    public $nis, $nik, $wali_anak, $tgl_masuk, $tgl_keluar, $foto, $nama_lengkap, $jenis_kelamin, $tempat_lahir, $tanggal_lahir, $alamat, $tipe, $status, $pendidikan, $nama_ayah_kandung, $nama_ibu_kandung, $nohp_ortu, $idAnak, $pemilik_nohp;

    public function render()
    {
        return view('livewire.create-anak-asuh');
    }

    public function rules()
    {
        $validation = [
            'nama_lengkap' => 'required',
            'jenis_kelamin' => 'required',
            'status' => 'required',
            'nohp_ortu' => 'required',
            'pemilik_nohp' => 'required',
            'wali_anak' => 'required',
            'tipe' => 'required',
            'nis' => 'unique:anak_asuhs,nis',
            'nik' => 'unique:anak_asuhs,nik',
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
            'nama_lengkap.required' => 'Nama harus diisi',
            'jenis_kelamin.required' => 'Jenis kelamin harus diisi',
            'status.required' => 'Status harus diisi',
            'pemilik_nohp.required' => 'Nama wali harus diisi',
            'nohp_ortu.required' => 'Nomor handphone wali harus diisi',
            'wali_anak.required' => 'Wali anak harus diisi',
            'tipe.required' => 'Tipe harus diisi',
            'nis.unique' => 'Nomor Induk Siswa sudah digunakan',
            'nik.unique' => 'Nomor Induk Keluarga sudah digunakan',
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
            'wali_anak' => $this->wali_anak,
            'tgl_masuk' => $this->tgl_masuk,
            'tgl_keluar' => $this->tgl_keluar,
            'nis' => $this->nis,
            'nik' => $this->nik,
        ]);

        $role = Auth::user()->role;

        if ($this->tipe == 'Santri Dalam') {
            return redirect()->route('santri.dalam')->with('message', 'Data santri berhasil ditambahkan');
        } else if ($this->tipe == 'Santri Luar') {
            return redirect()->route('santri.luar')->with('message', 'Data santri berhasil ditambahkan');
        } else if ($this->tipe == 'Alumni') {
            return redirect()->route('santri.alumni')->with('message', 'Data santri berhasil ditambahkan');
        }
    }

    public function downloadTemplate()
    {
        return response()->download(public_path('template/import/template import santri.xlsx'));
    }
}
