<?php

namespace App\Http\Livewire;

use Exception;
use Carbon\Carbon;
use Livewire\Component;
use App\Models\Pengurus;
use Livewire\WithFileUploads;
use App\Models\MasterDataPosition;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\MasterDataPendidikan;

class CreatePengurus extends Component
{
    public $foto, $nama, $no_hp, $jenis_kelamin, $tempat_lahir, $tanggal_lahir, $jabatan, $alamat, $pendidikan, $pekerjaan, $nik;
    use WithFileUploads;

    public function render()
    {
        $pendidikans = MasterDataPendidikan::get();
        $positions = MasterDataPosition::get();

        $data = [
            'pendidikans' => $pendidikans,
            'positions' => $positions,
        ];
        return view('livewire.create-pengurus', $data);
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
            'nik' => 'unique:penguruses,nik',
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
            'nik.unique' => 'NIK sudah dipakai',
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

        try {
            DB::beginTransaction();

            Pengurus::create([
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
                'order' => Pengurus::max('order') + 1
            ]);

            DB::commit();
            return redirect()->to('pengurus')->with('message', 'Data pengurus berhasil ditambahkan');
        } catch (Exception $e) {
            Log::debug($e);
            DB::rollBack();
            $this->dispatchBrowserEvent('show-error', ['message' => 'Error, Coba untuk input data lagi atau hubungi developer']);
        }
    }
}
