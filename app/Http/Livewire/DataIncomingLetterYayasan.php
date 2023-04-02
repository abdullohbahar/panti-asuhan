<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\LetterYayasan;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\WithFileUploads;

class DataIncomingLetterYayasan extends Component
{
    public $search;
    public $file;
    public $nomor_surat;
    public $nama_pengirim;
    public $perihal_surat;
    public $tanggal;
    public $isi_surat;
    public $oldSurat;
    public $idLetter;
    public $iteration;
    public $destroyBerkas;
    use WithFileUploads;
    protected $listeners = ['deleteConfirmed' => 'destroy'];


    public function render()
    {
        $search = '';

        $letters = LetterYayasan::where('tipe', 'Surat Masuk')->when(!empty($this->search), function ($query) {
            $query->where('perihal_surat', 'like', "%$this->search%");
        })->paginate(20);

        $data = [
            'letters' => $letters
        ];

        return view('livewire.data-incoming-letter-yayasan', $data);
    }

    public function download($downloadFile, $nama)
    {
        $ext = substr(strrchr($downloadFile, '.'), 1);
        return response()->download(public_path('storage/' . $downloadFile), $nama . '.' . $ext);
    }

    public function show($id)
    {
        $this->iteration++;
        $letter = LetterYayasan::find($id);

        if ($letter) {
            $this->idLetter = $letter->id;
            $this->nomor_surat = $letter->nomor_surat;
            $this->nama_pengirim = $letter->nama_pengirim;
            $this->isi_surat = $letter->isi_surat;
            $this->tanggal = $letter->tanggal;
            $this->perihal_surat = $letter->perihal_surat;
            $this->oldSurat = $letter->file;
        }
    }

    public function rules()
    {
        return [
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
            'nama_pengirim.required' => 'Nama pengirim harus diisi',
            'nomor_surat.required' => 'Nomor Surat harus diisi',
            'perihal_surat.required' => 'Perihal Surat harus diisi',
            'tanggal.required' => 'Tanggal surat harus diisi',
            'isi_surat.required' => 'Isi Surat harus diisi',
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
                'nama_pengirim' => $this->nama_pengirim,
                'nomor_surat' => $this->nomor_surat,
                'perihal_surat' => $this->perihal_surat,
                'tanggal' => $this->tanggal,
                'tipe' => 'Surat Masuk',
                'isi_surat' => $this->isi_surat,
            ];

            if ($this->file) {
                if (file_exists(public_path('storage/' . $this->oldSurat))) {
                    unlink(public_path('storage/' . $this->oldSurat));
                }
                $file = $this->file->store('yayasan/surat-masuk', 'public');
                $data['file'] = $file;
            }

            // Update data
            LetterYayasan::where('id', $this->idLetter)->update($data);

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
        LetterYayasan::destroy($this->idLetter);

        $this->dispatchBrowserEvent('deleted', ['message' => 'Data Berhasil Dihapus']);
    }
}
