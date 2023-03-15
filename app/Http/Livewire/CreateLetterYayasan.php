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
            'nomor_surat' => 'required',
            'tipe' => 'required',
            'keterangan' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'file.required' => 'Surat harus diisi',
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
            ]);

            DB::commit();
        } catch (Exception $e) {
            Log::debug($e);
            DB::rollBack();
            dd($e);
        }
    }
}
