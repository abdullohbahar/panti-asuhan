<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\LksaDocument as ModelsLksaDocument;
use Livewire\WithPagination;

class LksaDocument extends Component
{
    public $search, $name, $file, $iteration, $downloadBerkas, $idBerkas, $destroyBerkas;
    use WithFileUploads;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['deleteConfirmed' => 'destroy'];

    public function render()
    {
        $search = '';

        $documents = ModelsLksaDocument::when(!empty($this->search), function ($query) use ($search) {
            $query->where('name', 'like', '%' . $this->search . '%');
        })->paginate(15);

        $count = $documents->count();

        $data = [
            'active' => 'lksa-document',
            'documents' => $documents,
            'count' => $count,
            'iteration' => $this->iteration,
        ];

        return view('livewire.lksa-document', $data);
    }

    public function rules()
    {
        return [
            'name' => 'required',
            'file' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nama Berkas Harus Diisi',
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

        $file = $this->file->store('berkas/lksa', 'public');

        ModelsLksaDocument::create([
            'name' => $this->name,
            'file' => $file,
        ]);

        $this->resetInput();
        $this->dispatchBrowserEvent('close-modal', ['message' => 'Berhasil Upload Berkas']);
    }

    public function resetInput()
    {
        $this->name = '';
        $this->file = '';
        $this->iteration++;
    }

    public function download($id, $name)
    {
        // Nama File
        $this->downloadBerkas = $id;

        // Nama Dokumen
        $this->name = $name;

        // Get Extension
        $ext = substr(strrchr($this->downloadBerkas, '.'), 1);
        return response()->download(public_path('storage/' . $this->downloadBerkas), $this->name . '.' . $ext);
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

        ModelsLksaDocument::destroy($this->idBerkas);

        $this->dispatchBrowserEvent('deleted', ['message' => 'Berkas Berhasil Dihapus']);
    }
}
