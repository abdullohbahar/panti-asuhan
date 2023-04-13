<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\OutgoingLetterLksa;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CreateOutgoingLetterLksa extends Component
{
    public $nomor_surat;
    public $nomor_urutan;
    public $tanggal;
    public $perihal;
    public $tujuan;
    public $file;
    public $tanggal_diterima;
    public $disposisi_penugasan;
    public $file_dokumentasi;

    use WithFileUploads;

    public function render()
    {
        $data = [
            'active' => 'create-outgoing-letter-lksa'
        ];

        return view('livewire.create-outgoing-letter-lksa')->layout('create-outgoing-letter-lksa', $data);
    }

    public function rules()
    {
        return [
            'nomor_surat' => 'required',
            'nomor_urutan' => 'required',
            'tanggal' => 'required',
            'perihal' => 'required',
            'tujuan' => 'required',
            'file' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'nomor_surat.required' => 'Nomor surat harus diisi',
            'nomor_urutan.required' => 'Nomor ururtan harus diisi',
            'tanggal.required' => 'Tanggal harus diisi',
            'perihal.required' => 'Perihal harus diisi',
            'tujuan.required' => 'Tujuan harus diisi',
            'file.required' => 'Surat harus diisi',
        ];
    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function store()
    {
        $this->validate();

        try {
            DB::beginTransaction();

            $file = $this->file->store('lksa/surat-keluar', 'public');

            if ($this->file_dokumentasi) {
                $fileDokumentasi = $this->file_dokumentasi->store('lksa/dokumentasi', 'public');
            } else {
                $fileDokumentasi = "";
            }

            OutgoingLetterLksa::create([
                'nomor_surat' => $this->nomor_surat,
                'nomor_urutan' => $this->nomor_urutan,
                'tanggal' => $this->tanggal,
                'perihal' => $this->perihal,
                'tujuan' => $this->tujuan,
                'file' => $file,
                'tanggal_diterima' => $this->tanggal_diterima,
                'disposisi_penugasan' => $this->disposisi_penugasan,
                'file_dokumentasi' => $fileDokumentasi,
            ]);

            DB::commit();
            return redirect()->route('data.outcome.letter.lksa')->with('message', 'Surat Keluar Berhasil Ditambahkan');
        } catch (Exception $e) {
            Log::critical($e);
            DB::rollBack();
            $this->dispatchBrowserEvent('show-error', ['message' => 'Error, Coba untuk input data lagi atau hubungi developer']);
        }
    }
}
