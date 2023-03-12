<?php

namespace App\Http\Livewire;

use App\Models\AnakAsuh;
use App\Models\ChildDocument;
use Livewire\Component;
use Livewire\WithFileUploads;

class ProfileAnak extends Component
{
    public $idchild, $nama_dokumen, $file, $iteration, $downloadBerkas, $namaDokumen, $idBerkas, $destroyBerkas, $search;
    use WithFileUploads;

    protected $listeners = ['deleteConfirmed' => 'destroy'];

    public function render()
    {
        $search = '';

        $anak = AnakAsuh::find($this->idchild);
        $documents = ChildDocument::where('anak_asuh_id', $this->idchild)
            ->when(!empty($this->search), function ($q) use ($search) {
                $q->where('nama_dokumen', 'like', "%{$this->search}%");
            })
            ->get();

        $data = [
            'anak' => $anak,
            'documents' => $documents
        ];

        return view('livewire.profile-anak', $data);
    }

    public function rules()
    {
        return [
            'nama_dokumen' => 'required',
            'file' => 'required|max:2048|mimes:pdf,png,jpg',
        ];
    }

    public function messages()
    {
        return [
            'nama_dokumen.required' => 'Nama Berkas Harus Diisi',
            'file.required' => 'Berkas Harus Diisi',
            'file.max' => 'Ukuran max 2MB',
            'file.mimes' => 'File harus berupa PDF, PNG, JPG',
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

        ChildDocument::create([
            'anak_asuh_id' => $this->idchild,
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
        $namaAnak = AnakAsuh::find($this->idchild);

        // Nama File
        $this->downloadBerkas = $id;

        // Nama Dokumen
        $this->namaDokumen = $namaDokumen;

        // Get Extension
        $ext = substr(strrchr($this->downloadBerkas, '.'), 1);
        return response()->download(public_path('storage/' . $this->downloadBerkas), $namaAnak->nama_lengkap . ' - ' . $this->namaDokumen . '.' . $ext);
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
        ChildDocument::destroy($this->idBerkas);

        $this->dispatchBrowserEvent('deleted', ['message' => 'Berkas Berhasil Dihapus']);
    }
}
