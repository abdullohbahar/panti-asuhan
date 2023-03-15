<?php

namespace App\Http\Livewire;

use Exception;
use Livewire\Component;
use App\Models\LetterYayasan;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CreateLetterYayasan extends Component
{

    use WithFileUploads;

    public $file;
    public $nomor_surat;
    public $nama_surat;
    public $tipe;
    public $keterangan;

    public function render()
    {
        return view('livewire.create-letter-yayasan');
    }

    public function rules()
    {
        return [
            'file' => 'required',
            'nama_surat' => 'required',
            'nomor_surat' => 'required',
            'tipe' => 'required',
            'keterangan' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'file.required' => 'Surat harus diisi',
            'nama_surat.required' => 'Nama Surat harus diisi',
            'nomor_surat.required' => 'Nomor Surat harus diisi',
            'tipe.required' => 'Tipe harus diisi',
            'keterangan.required' => 'Keterangan harus diisi',
        ];
    }

    public function updated($fields)
    {
        return $this->validateOnly($fields);
    }

    public function store()
    {
        $validateData = $this->validate();

        try {
            DB::beginTransaction();

            $file = $this->file->store('yayasan/surat-masuk', 'public');

            LetterYayasan::create([
                'file' => $file,
                'nomor_surat' => $this->nomor_surat,
                'tipe' => $this->tipe,
                'keterangan' => $this->keterangan,
                'nama_surat' => $this->nama_surat,
            ]);

            DB::commit();

            if ($this->tipe == "Surat Masuk") {
                return redirect()->route('data.incoming.letter.yayasan')->with('message', 'Surat Masuk Berhasil Ditambahkan');
            } else {
                return redirect()->route('data.outcome.letter.yayasan')->with('message', 'Surat Keluar Berhasil Ditambahkan');
            }
        } catch (Exception $e) {
            Log::debug($e);
            DB::rollBack();
            $this->dispatchBrowserEvent('show-error', ['message' => 'Error, Coba untuk input data lagi atau hubungi developer']);
        }
    }
}
