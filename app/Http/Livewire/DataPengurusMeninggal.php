<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Pengurus;
use Livewire\WithPagination;

class DataPengurusMeninggal extends Component
{
    public $search, $idPengurus;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['deleteConfirmed' => 'destroy'];

    public function render()
    {

        $search = '';

        $penguruses = Pengurus::where('status', 'Pengurus Meninggal')->where(function ($q) use ($search) {
            $q->orwhere('nama', 'like', '%' . $this->search . '%')
                ->orwhere('jabatan', 'like', '%' . $this->search . '%');
        })->orderBy('order', 'asc')->get();

        $data =  [
            'penguruses' => $penguruses,
        ];

        return view('livewire.data-pengurus-meninggal', $data)->layout('data-pengurus-meninggal', [
            'active' => 'data-pengurus-meninggal'
        ]);
    }

    public function deleteConfirmation($id)
    {
        $this->idPengurus = $id;
        $this->dispatchBrowserEvent('show-delete-confirmation');
    }

    public function destroy()
    {
        Pengurus::destroy($this->idPengurus);

        $this->dispatchBrowserEvent('deleted', ['message' => 'Data Pengurus Berhasil Dihapus']);
    }
}
