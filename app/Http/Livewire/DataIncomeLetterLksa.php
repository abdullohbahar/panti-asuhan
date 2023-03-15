<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\LetterLksa;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;

class DataIncomeLetterLksa extends Component
{
    public $search;
    public $file;
    public $nomor_surat;
    public $nama_surat;
    public $tipe;
    public $keterangan;
    public $oldSurat;
    public $idLetter;
    public $iteration;
    public $destroyBerkas;
    use WithFileUploads;
    protected $listeners = ['deleteConfirmed' => 'destroy'];


    public function render()
    {
        $search = '';

        $letters = LetterLksa::where('tipe', 'Surat Masuk')->when(!empty($this->search), function ($query) {
            $query->where('nama_surat', 'like', "%$this->search%");
        })->paginate(20);

        $data = [
            'letters' => $letters
        ];

        return view('livewire.data-income-letter-lksa', $data);
    }

    public function download($downloadFile, $nama)
    {
        $ext = substr(strrchr($downloadFile, '.'), 1);
        return response()->download(public_path('storage/' . $downloadFile), $nama . '.' . $ext);
    }

    public function show($id)
    {
        $this->iteration++;
        $letter = LetterLksa::find($id);

        if ($letter) {
            $this->idLetter = $letter->id;
            $this->nomor_surat = $letter->nomor_surat;
            $this->nama_surat = $letter->nama_surat;
            $this->tipe = $letter->tipe;
            $this->keterangan = $letter->keterangan;
            $this->oldSurat = $letter->file;
        }
    }

    public function rules()
    {
        return [
            'nama_surat' => 'required',
            'nomor_surat' => 'required',
            'tipe' => 'required',
            'keterangan' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'nama_surat.required' => 'Nama Surat harus diisi',
            'nomor_surat.required' => 'Nomor Surat harus diisi',
            'tipe.required' => 'Tipe harus diisi',
            'keterangan.required' => 'Keterangan harus diisi',
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
                'nama_surat' => $this->nama_surat,
                'nomor_surat' => $this->nomor_surat,
                'tipe' => $this->tipe,
                'keterangan' => $this->keterangan,
            ];

            if ($this->file) {
                unlink(public_path('storage/' . $this->oldSurat));
                $file = $this->file->store('lksa/surat-masuk', 'public');
                $data['file'] = $file;
            }

            // Update data
            LetterLksa::where('id', $this->idLetter)->update($data);

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
        unlink(public_path('storage/' . $this->destroyBerkas));
        LetterLksa::destroy($this->idLetter);

        $this->dispatchBrowserEvent('deleted', ['message' => 'Data Berhasil Dihapus']);
    }
}
