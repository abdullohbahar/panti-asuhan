<?php

namespace App\Http\Livewire;

use App\Models\Donatur as ModelsDonatur;
use Livewire\Component;
use Livewire\WithPagination;

class Donatur extends Component
{
    public $nama, $alamat, $id_donatur, $search;

    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['deleteConfirmed' => 'destroy'];

    public function render()
    {
        $search = '';

        $query = ModelsDonatur::where(function ($q) use ($search) {
            $q->orwhere('nama', 'like', '%' . $this->search . '%')
                ->orwhere('alamat', 'like', '%' . $this->search . '%');
        });

        $donaturs = $query->paginate(10);
        $count = $donaturs->count();

        $data = [
            'donaturs' => $donaturs,
            'count' => $count
        ];

        return view('livewire.donatur', $data);
    }

    public function rules()
    {
        return [
            'nama' => 'required',
            'alamat' => 'required'
        ];
    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function store()
    {
        $validateData = $this->validate();

        ModelsDonatur::create($validateData);
        $this->resetInput();
        $this->dispatchBrowserEvent('close-modal', ['message' => 'Donatur Berhasil Ditambahkan']);
    }

    public function resetInput()
    {
        $this->nama = '';
        $this->alamat = '';
    }

    public function show($id)
    {
        $donatur = ModelsDonatur::find($id);
        if ($donatur) {
            $this->id_donatur = $donatur->id;
            $this->nama = $donatur->nama;
            $this->alamat = $donatur->alamat;
        }
    }

    public function update()
    {
        $validateData = $this->validate();

        ModelsDonatur::where('id', $this->id_donatur)->update([
            'nama' => $this->nama,
            'alamat' => $this->alamat
        ]);

        $this->dispatchBrowserEvent('close-modal', ['message' => 'Donatur Berhasil Diubah']);
    }

    public function deleteConfirmation($id)
    {
        $this->id_donatur = $id;
        $this->dispatchBrowserEvent('show-delete-confirmation');
    }

    public function destroy()
    {
        ModelsDonatur::destroy($this->id_donatur);
        $this->dispatchBrowserEvent('deleted', ['message' => 'Donatur Berhasil Dihapus']);
    }
}
