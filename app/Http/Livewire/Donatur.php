<?php

namespace App\Http\Livewire;

use App\Exports\DonaturExport;
use App\Models\Donatur as ModelsDonatur;
use Livewire\Component;
use Livewire\WithPagination;

class Donatur extends Component
{
    public $nama, $alamat, $id_donatur, $search, $no_hp;

    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['deleteConfirmed' => 'destroy'];

    public function render()
    {
        $search = '';

        $query = ModelsDonatur::where(function ($q) use ($search) {
            $q->orwhere('nama', 'like', '%' . $this->search . '%')
                ->orwhere('alamat', 'like', '%' . $this->search . '%');
        })->orderBy('nama', 'asc');

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
            'alamat' => 'required',
            'no_hp' => 'required|unique:donaturs,no_hp'
        ];
    }

    public function messages()
    {
        return [
            'nama.required' => 'Nama harus diisi',
            'alamat.required' => 'Alamat harus diisi',
            'no_hp.required' => 'Nomor HP harus diisi',
            'no_hp.unique' => 'Nomor HP sudah terdaftar'
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
        $this->no_hp = '';
    }

    public function show($id)
    {
        $donatur = ModelsDonatur::find($id);
        if ($donatur) {
            $this->id_donatur = $donatur->id;
            $this->nama = $donatur->nama;
            $this->no_hp = $donatur->no_hp;
            $this->alamat = $donatur->alamat;
        }
    }

    public function update()
    {
        $validateData = $this->validate();

        ModelsDonatur::where('id', $this->id_donatur)->update([
            'nama' => $this->nama,
            'alamat' => $this->alamat,
            'no_hp' => $this->no_hp
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

    public function exportExcel()
    {
        return (new DonaturExport)->download('Donatur.xlsx');
    }

    public function downloadTemplate()
    {
        return response()->download(public_path('template/import/template import donatur.xlsx'));
    }
}
