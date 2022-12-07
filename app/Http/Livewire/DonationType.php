<?php

namespace App\Http\Livewire;

use App\Models\DonationType as ModelsDonationType;
use Livewire\Component;
use Livewire\WithPagination;

class DonationType extends Component
{
    public $jenis_donasi, $id_jenis, $search;

    protected $listeners = ['deleteConfirmed' => 'destroy'];

    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $search = '';

        $query = ModelsDonationType::where(function ($q) use ($search) {
            $q->orwhere('jenis_donasi', 'like', '%' . $this->search . '%');
        });

        $types = $query->paginate(10);
        $count = $types->count();

        $data = [
            'types' => $types,
            'count' => $count
        ];

        return view('livewire.donation-type', $data);
    }

    public function rules()
    {
        return [
            'jenis_donasi' => 'required|unique:donation_types'
        ];
    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function store()
    {
        $validateData = $this->validate();

        ModelsDonationType::create($validateData);

        $this->resetInput();
        $this->dispatchBrowserEvent('close-modal', ['message' => 'Tipe Berhasil Ditambahkan']);
    }

    public function resetInput()
    {
        $this->jenis_donasi = '';
    }

    public function show($id)
    {
        $type = ModelsDonationType::find($id);

        if ($type) {
            $this->id_jenis = $type->id;
            $this->jenis_donasi = $type->jenis_donasi;
        }
    }

    public function update()
    {
        $validateData = $this->validate();

        ModelsDonationType::where('id', $this->id_jenis)->update([
            'jenis_donasi' => $this->jenis_donasi,
        ]);

        $this->dispatchBrowserEvent('close-modal', ['message' => 'Tipe Donasi Berhasil Diubah']);
    }

    public function deleteConfirmation($id)
    {
        $this->id_jenis = $id;
        $this->dispatchBrowserEvent('show-delete-confirmation');
    }

    public function destroy()
    {
        ModelsDonationType::destroy($this->id_jenis);
        $this->dispatchBrowserEvent('deleted', ['message' => 'Tipe Donasi Berhasil Dihapus']);
    }
}
