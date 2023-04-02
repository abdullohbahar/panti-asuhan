<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\LetterLksa;
use App\Models\OutgoingLetterLksa;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;

class DataOutcomeLetterLksa extends Component
{
    public $search;
    public $nomor_surat;
    public $nomor_urutan;
    public $tanggal;
    public $perihal;
    public $tujuan;
    public $file;
    public $tanggal_diterima;
    public $disposisi_penugasan;
    public $file_dokumentasi;
    public $idLetter;
    public $old_file_dokumentasi;
    public $oldSurat;
    public $iteration;
    public $destroyBerkas;
    use WithFileUploads;
    protected $listeners = ['deleteConfirmed' => 'destroy'];

    public function render()
    {
        $search = '';

        $letters = OutgoingLetterLksa::when(!empty($this->search), function ($query) {
            $query->where('perihal', 'like', "%$this->search%");
        })->paginate(20);

        $data = [
            'letters' => $letters
        ];

        return view('livewire.data-outcome-letter-lksa', $data);
    }

    public function download($downloadFile, $nama)
    {
        $ext = substr(strrchr($downloadFile, '.'), 1);
        return response()->download(public_path('storage/' . $downloadFile), $nama . '.' . $ext);
    }

    public function show($id)
    {
        $this->iteration++;
        $letter = OutgoingLetterLksa::find($id);

        if ($letter) {
            $this->idLetter = $letter->id;
            $this->nomor_surat = $letter->nomor_surat;
            $this->nomor_urutan = $letter->nomor_urutan;
            $this->tanggal = $letter->tanggal;
            $this->perihal = $letter->perihal;
            $this->tujuan = $letter->tujuan;
            $this->tanggal_diterima = $letter->tanggal_diterima;
            $this->disposisi_penugasan = $letter->disposisi_penugasan;
            $this->old_file_dokumentasi = $letter->file_dokumentasi;
            $this->oldSurat = $letter->file;
        }
    }

    public function rules()
    {
        return [
            'nomor_surat' => 'required',
            'nomor_urutan' => 'required',
            'tanggal' => 'required',
            'perihal' => 'required',
            'tujuan' => 'required',
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
        ];
    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function update()
    {
        // Validate Data
        $validateData = $this->validate();

        try {
            DB::beginTransaction();

            $data = [
                'nomor_surat' => $this->nomor_surat,
                'nomor_urutan' => $this->nomor_urutan,
                'tanggal' => $this->tanggal,
                'perihal' => $this->perihal,
                'tujuan' => $this->tujuan,
                'tanggal_diterima' => $this->tanggal_diterima,
                'disposisi_penugasan' => $this->disposisi_penugasan,
            ];

            if ($this->file) {
                if (file_exists(public_path('storage/' . $this->oldSurat))) {
                    if ($this->old_file_dokumentasi) {
                        unlink(public_path('storage/' . $this->oldSurat));
                    }
                }
                $file = $this->file->store('lksa/surat-keluar', 'public');
                $data['file'] = $file;
            }

            if ($this->file_dokumentasi) {
                if (file_exists(public_path('storage/' . $this->old_file_dokumentasi))) {
                    if ($this->old_file_dokumentasi) {
                        unlink(public_path('storage/' . $this->old_file_dokumentasi));
                    }
                }
                $fileDokumentasi = $this->file_dokumentasi->store('lksa/dokumentasi', 'public');
                $data['file_dokumentasi'] = $fileDokumentasi;
            }

            // Update data
            OutgoingLetterLksa::where('id', $this->idLetter)->update($data);

            DB::commit();

            $this->dispatchBrowserEvent('show-success', ['message' => 'Berhasil diubah']);
        } catch (QueryException $e) {
            Log::debug($e);
            DB::rollBack();
            $this->dispatchBrowserEvent('show-error', ['message' => 'Error, Coba untuk input data lagi atau hubungi developer']);
        }
    }

    public function deleteConfirmation($id, $destroyBerkas)
    {
        $this->idLetter = $id;
        $this->destroyBerkas = $destroyBerkas;
        $this->dispatchBrowserEvent('show-delete-confirmation');
    }

    public function destroy()
    {
        if (file_exists(public_path('storage/' . $this->destroyBerkas))) {
            unlink(public_path('storage/' . $this->destroyBerkas));
        }
        OutgoingLetterLksa::destroy($this->idLetter);

        $this->dispatchBrowserEvent('deleted', ['message' => 'Data Berhasil Dihapus']);
    }
}
