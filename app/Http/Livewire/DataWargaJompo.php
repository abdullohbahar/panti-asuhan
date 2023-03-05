<?php

namespace App\Http\Livewire;

use App\Models\Citizen;
use Livewire\Component;
use Livewire\WithPagination;

class DataWargaJompo extends Component
{
    public $search, $idWarga;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['deleteConfirmed' => 'destroy'];

    public function render()
    {
        $search = '';

        $query = Citizen::where('status', 'Jompo')->where(function ($q) use ($search) {
            $q->orwhere('nama_lengkap', 'like', '%' . $this->search . '%')
                ->orwhere('tempat_lahir', 'like', '%' . $this->search . '%')
                ->orwhere('tanggal_lahir', 'like', '%' . $this->search . '%');
        });

        $citizens = $query->orderBy('nama_lengkap', 'asc')->paginate(15);
        $count = $citizens->count();

        $data =  [
            'citizens' => $citizens,
            'count' => $count
        ];

        return view('livewire.data-warga-jompo', $data);
    }

    public function deleteConfirmation($id)
    {
        $this->idWarga = $id;
        $this->dispatchBrowserEvent('show-delete-confirmation');
    }

    public function destroy()
    {
        Citizen::destroy($this->idWarga);

        $this->dispatchBrowserEvent('deleted', ['message' => 'Data Warga Berhasil Dihapus']);
    }

    // public function exportExcel()
    // {
    //     return Excel::download(new AnakAsuhExport, 'Data Anak Asuh.xlsx');
    // }
}
