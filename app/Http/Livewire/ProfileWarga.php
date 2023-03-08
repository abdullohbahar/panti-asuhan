<?php

namespace App\Http\Livewire;

use App\Models\Citizen;
use Livewire\Component;
use App\Models\CitizenDocument;
use Livewire\WithFileUploads;

class ProfileWarga extends Component
{
    public $idwarga, $nama_dokumen, $file, $iteration, $downloadBerkas, $namaDokumen, $idBerkas, $destroyBerkas, $search;
    use WithFileUploads;
    protected $listeners = ['deleteConfirmed' => 'destroy'];


    public function render()
    {
        $search = '';

        $citizen = Citizen::find($this->idwarga);
        $documents = CitizenDocument::where('citizen_id', $this->idwarga)
            ->when(!empty($this->search), function ($q) use ($search) {
                $q->where('nama_dokumen', 'like', "%{$this->search}%");
            })
            ->get();

        $data = [
            'citizen' => $citizen,
            'documents' => $documents
        ];

        return view('livewire.profile-warga', $data);
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

        CitizenDocument::create([
            'citizen_id' => $this->idwarga,
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
        $namaAnak = Citizen::find($this->idwarga);

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
        CitizenDocument::destroy($this->idBerkas);

        $this->dispatchBrowserEvent('deleted', ['message' => 'Berkas Berhasil Dihapus']);
    }
}
