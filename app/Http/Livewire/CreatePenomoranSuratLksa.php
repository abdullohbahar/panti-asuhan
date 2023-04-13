<?php

namespace App\Http\Livewire;

use Exception;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use App\Models\NumberingLetterLksa;
use Illuminate\Support\Facades\Log;

class CreatePenomoranSuratLksa extends Component
{
    public $file;
    public $perihal;
    public $tgl_keluar;
    public $tujuan;
    use WithFileUploads;

    public function render()
    {
        return view('livewire.create-penomoran-surat-lksa')->extends('create-penomoran-surat-lksa', [
            'active' => 'create-penomoran-surat-lksa'
        ]);
    }

    public function rules()
    {
        return [
            'file' => 'required',
            'perihal' => 'required',
            'tgl_keluar' => 'required',
            'tujuan' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'file.required' => 'Surat harus diisi',
            'perihal.required' => 'Perihal surat harus diisi',
            'tgl_keluar.required' => 'Tanggal keluar surat harus diisi',
            'tujuan.required' => 'Tujuan harus diisi',
        ];
    }

    public function updated($fileds)
    {
        $this->validateOnly($fileds);
    }

    public function store()
    {
        $this->validate();

        try {
            DB::beginTransaction();

            // Get Filename
            $fileName = $this->file->getClientOriginalName();

            // store file
            $file = $this->file->store('penomoran-surat-lksa', 'public');

            // Get number file
            $number = NumberingLetterLksa::where('tgl_keluar', $this->tgl_keluar)->orderBy('created_at')->first();

            // Increase number
            if ($number?->nomor) {
                $number = $number->nomor + 1;
            } else {
                $number = 1;
            }

            NumberingLetterLksa::create([
                'file' => $file,
                'filename' => $fileName,
                'perihal' => $this->perihal,
                'tgl_keluar' => $this->tgl_keluar,
                'tujuan' => $this->tujuan,
                'nomor' => $number,
            ]);

            DB::commit();
            return redirect()->to('data-penomoran-surat-lksa')->with('message', 'Data berhasil ditambahkan');
        } catch (Exception $e) {
            Log::critical($e);
            DB::rollBack();
            $this->dispatchBrowserEvent('show-error', ['message' => 'Error, Coba untuk input data lagi atau hubungi developer']);
        }
    }
}
