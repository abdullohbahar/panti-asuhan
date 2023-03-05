<?php

namespace App\Http\Livewire;

use App\Models\DocumentPengurus;
use App\Models\Pengurus;
use Livewire\Component;
use Livewire\WithFileUploads;

class ProfilePengurus extends Component
{
    use WithFileUploads;
    public $idpengurus, $iteration, $nama_dokumen, $file, $downloadBerkas, $namaDokumen, $idBerkas, $destroyBerkas, $search;
    protected $listeners = ['deleteConfirmed' => 'destroy'];

    public function render()
    {
        $search = '';

        $pengurus = Pengurus::find($this->idpengurus);
        $documents = DocumentPengurus::where('pengurus_id', $this->idpengurus)
            ->when(!empty($this->search), function ($q) use ($search) {
                $q->where('nama_dokumen', 'like', "%{$this->search}%");
            })
            ->get();

        $data = [
            'pengurus' => $pengurus,
            'documents' => $documents
        ];

        return view('livewire.profile-pengurus', $data);
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

        DocumentPengurus::create([
            'pengurus_id' => $this->idpengurus,
            'nama_dokumen' => $this->nama_dokumen,
            'file' => $file,
        ]);

        $this->resetInput();
        $this->dispatchBrowserEvent('close-modal', ['message' => 'Berhasil Upload Berkas']);
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
        $namaPengurus = Pengurus::find($this->idpengurus);

        // Nama File
        $this->downloadBerkas = $id;

        // Nama Dokumen
        $this->namaDokumen = $namaDokumen;

        // Get Extension
        $ext = substr(strrchr($this->downloadBerkas, '.'), 1);
        return response()->download(public_path('storage/' . $this->downloadBerkas), $namaPengurus->nama . ' - ' . $this->namaDokumen . '.' . $ext);
    }

    public function deleteConfirmation($destroyBerkas, $id)
    {
        $this->idBerkas = $id;
        $this->destroyBerkas = $destroyBerkas;
        $this->dispatchBrowserEvent('show-delete-confirmation');
    }

    public function destroy()
    {
        unlink(public_path('storage/' . $this->destroyBerkas));
        DocumentPengurus::destroy($this->idBerkas);

        $this->dispatchBrowserEvent('deleted', ['message' => 'Berkas Berhasil Dihapus']);
    }
}
