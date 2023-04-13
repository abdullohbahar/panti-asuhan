<?php

namespace App\Http\Livewire\Import;

use App\Imports\ImportPengeluaranYayasan as ImportsImportPengeluaranYayasan;
use Livewire\Component;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;


class ImportPengeluaranYayasan extends Component
{

    public $file, $iteration;
    use WithFileUploads;

    public function render()
    {
        return view('livewire.import.import-pengeluaran-yayasan');
    }

    public function rules()
    {
        return [
            'file' => 'required|mimes:csv,xls,xlsx',
        ];
    }

    public function messages()
    {
        return [
            'file.required' => 'File harus diisi',
            'file.mimes' => 'File harus csv, xls, xlsx',
        ];
    }

    public function update($fields)
    {
        $this->validateOnly($fields);
    }

    public function resetInput()
    {
        $this->iteration++;
    }

    public function store()
    {
        $this->validate();

        $fileName = $this->file->store('import/import-keuangan-lksa', 'public');

        Excel::import(new ImportsImportPengeluaranYayasan, public_path('/storage/' . $fileName));

        $this->resetInput();
        $this->dispatchBrowserEvent('success-import', ['message' => 'Berhasil melakukan import data']);
    }
}
