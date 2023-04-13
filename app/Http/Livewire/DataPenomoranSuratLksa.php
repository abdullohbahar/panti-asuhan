<?php

namespace App\Http\Livewire;

use Exception;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use App\Models\NumberingLetterLksa;
use Illuminate\Support\Facades\Log;

class DataPenomoranSuratLksa extends Component
{
    use WithPagination;
    use WithFileUploads;
    protected $paginationTheme = 'bootstrap';
    public $search;
    public $file;
    public $oldFile;
    public $perihal;
    public $tgl_keluar;
    public $tujuan;
    public $dataId;
    public $destroyBerkas;
    protected $listeners = ['deleteConfirmed' => 'destroy'];

    public function render()
    {
        $dataPenomoranSuratLksa = NumberingLetterLksa::when(!empty($this->search), function ($query) {
            $query->where('perihal', 'like', "%$this->search%");
        })->orderBy('tgl_keluar', 'desc')->orderBy('nomor', 'asc')->paginate(20);

        $data = [
            'datas' => $dataPenomoranSuratLksa
        ];

        return view('livewire.data-penomoran-surat-lksa', $data)->extends('data-penomoran-surat-lksa', [
            'active' => 'data-penomoran-surat-lksa'
        ]);;
    }

    public function download($downloadFile, $nama)
    {
        return response()->download(public_path('storage/' . $downloadFile), $nama);
    }

    public function show($id)
    {
        $data = NumberingLetterLksa::findorfail($id);

        $this->dataId = $data->id;
        $this->oldFile = $data->file;
        $this->perihal = $data->perihal;
        $this->tgl_keluar = $data->tgl_keluar;
        $this->tujuan = $data->tujuan;
    }

    public function rules()
    {
        return [
            'perihal' => 'required',
            'tgl_keluar' => 'required',
            'tujuan' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'perihal.required' => 'Perihal surat harus diisi',
            'tgl_keluar.required' => 'Tanggal keluar surat harus diisi',
            'tujuan.required' => 'Tujuan harus diisi',
        ];
    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function update()
    {
        try {
            DB::beginTransaction();

            $data = [
                'perihal' => $this->perihal,
                'tgl_keluar' => $this->tgl_keluar,
                'tujuan' => $this->tujuan,
            ];

            // Check is date already exist
            // if already exist add number with highest number
            $number = NumberingLetterLksa::where('tgl_keluar', $this->tgl_keluar)->orderBy('nomor', 'desc')->first();

            // Increase number
            if ($number?->nomor) {
                $data['nomor'] = $number->nomor + 1;
            }

            if ($this->file) {
                // Get Filename
                $fileName = $this->file->getClientOriginalName();

                // store file
                $file = $this->file->store('penomoran-surat-lksa', 'public');

                if (file_exists(public_path('storage/' . $this->oldFile))) {
                    if ($this->oldFile) {
                        unlink(public_path('storage/' . $this->oldFile));
                    }
                }

                $data['file'] = $file;
                $data['fileName'] = $fileName;
            }

            NumberingLetterLksa::where('id', $this->dataId)->update($data);

            DB::commit();
            return redirect()->to('data-penomoran-surat-lksa')->with('message', 'Data berhasil diubah');
        } catch (Exception $e) {
            Log::critical($e);
            DB::rollBack();
            $this->dispatchBrowserEvent('show-error', ['message' => 'Error, Coba untuk input data lagi atau hubungi developer']);
        }
    }

    public function deleteConfirmation($id, $destroyBerkas)
    {
        $this->dataId = $id;
        $this->destroyBerkas = $destroyBerkas;
        $this->dispatchBrowserEvent('show-delete-confirmation');
    }

    public function destroy()
    {
        if (file_exists(public_path('storage/' . $this->destroyBerkas))) {
            unlink(public_path('storage/' . $this->destroyBerkas));
        }

        NumberingLetterLksa::destroy($this->dataId);

        $this->dispatchBrowserEvent('deleted', ['message' => 'Data Berhasil Dihapus']);
    }
}
