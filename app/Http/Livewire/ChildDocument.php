<?php

namespace App\Http\Livewire;

use App\Models\AnakAsuh;
use App\Models\ChildDocument as ModelsChildDocument;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class ChildDocument extends Component
{
    use WithFileUploads;
    public $idchild, $nama_dokumen, $file, $iteration, $downloadBerkas, $namaDokumen;

    public function render()
    {
        $child = AnakAsuh::find($this->idchild);
        $documents = ModelsChildDocument::where('anak_asuh_id', $this->idchild)->orderBy('nama_dokumen', 'asc')->get();

        $data = [
            'child' => $child,
            'documents' => $documents
        ];
        return view('livewire.child-document', $data);
    }

    public function rules()
    {
        return [
            'nama_dokumen' => 'required',
            'file' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'nama_dokumen.required' => 'Nama Berkas Harus Diisi',
            'file.required' => 'Berkas Harus Diisi'
        ];
    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function store()
    {
        $this->validate();

        $file = $this->file->store('berkas', 'public');

        ModelsChildDocument::create([
            'anak_asuh_id' => $this->idchild,
            'nama_dokumen' => $this->nama_dokumen,
            'file' => $file,
        ]);

        $this->resetInput();
        $this->dispatchBrowserEvent('close-modal', ['message' => 'Berhasil Upload Bukti Donasi']);
    }

    public function resetInput()
    {
        $this->nama_dokumen = '';
        $this->file = '';
        $this->iteration++;
    }

    public function download($id, $namaDokumen)
    {
        // Nama Anak
        $namaAnak = AnakAsuh::find($this->idchild);

        // Nama File
        $this->downloadBerkas = $id;

        // Nama Dokumen
        $this->namaDokumen = $namaDokumen;

        // Get Extension
        $ext = substr(strrchr($this->downloadBerkas, '.'), 1);
        return response()->download(public_path('storage/' . $this->downloadBerkas), $namaAnak->nama_lengkap . ' - ' . $this->namaDokumen . '.' . $ext);
    }
}
