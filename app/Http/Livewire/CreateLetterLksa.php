<?php

namespace App\Http\Livewire;

use Exception;
use Livewire\Component;
use App\Models\LetterLksa;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CreateLetterLksa extends Component
{
    use WithFileUploads;

    public $file;
    public $nomor_surat;
    public $nama_pengirim;
    public $perihal_surat;
    public $tanggal;
    public $isi_surat;
    public $tanggal_diterima;
    public $disposisi_penugasan;
    public $file_dokumentasi;

    public function render()
    {
        return view('livewire.create-letter-lksa');
    }

    public function rules()
    {
        return [
            'file' => 'required',
            'nama_pengirim' => 'required',
            'nomor_surat' => 'required',
            'perihal_surat' => 'required',
            'tanggal' => 'required',
            'isi_surat' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'file.required' => 'Surat harus diisi',
            'nama_pengirim.required' => 'Nama pengirim harus diisi',
            'nomor_surat.required' => 'Nomor Surat harus diisi',
            'perihal_surat.required' => 'Perihal Surat harus diisi',
            'tanggal.required' => 'Tanggal surat harus diisi',
            'isi_surat.required' => 'Isi Surat harus diisi',
        ];
    }

    public function updated($fields)
    {
        return $this->validateOnly($fields);
    }

    public function store()
    {
        $this->validate();

        try {
            DB::beginTransaction();

            $file = $this->file->store('lksa/surat-masuk', 'public');

            if ($this->file_dokumentasi) {
                $fileDokumentasi = $this->file_dokumentasi->store('lksa/dokumentasi', 'public');
            } else {
                $fileDokumentasi = "";
            }

            LetterLksa::create([
                'file' => $file,
                'nama_pengirim' => $this->nama_pengirim,
                'nomor_surat' => $this->nomor_surat,
                'perihal_surat' => $this->perihal_surat,
                'tanggal' => $this->tanggal,
                'tipe' => 'Surat Masuk',
                'isi_surat' => $this->isi_surat,
                'tanggal_diterima' => $this->tanggal_diterima,
                'disposisi_penugasan' => $this->disposisi_penugasan,
                'file_dokumentasi' => $fileDokumentasi,
            ]);

            DB::commit();

            return redirect()->route('data.incoming.letter.lksa')->with('message', 'Surat Masuk Berhasil Ditambahkan');
        } catch (Exception $e) {
            Log::debug($e);
            DB::rollBack();
            $this->dispatchBrowserEvent('show-error', ['message' => 'Error, Coba untuk input data lagi atau hubungi developer']);
        }
    }
}
