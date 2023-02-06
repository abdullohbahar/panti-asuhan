<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Exports\AnakAsuhExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\AnakAsuh as ModelsAnakAsuh;


class SantriLuar extends Component
{
    use WithFileUploads;
    public $search, $idAnak, $foto, $nama_lengkap, $jenis_kelamin, $tempat_lahir, $tanggal_lahir, $alamat, $keterangan, $status, $akta, $kartu_keluarga, $nama_ayah_kandung, $nama_ibu_kandung, $nohp_ortu;
    protected $listeners = ['deleteConfirmed' => 'destroy'];
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $search = '';

        $query = ModelsAnakAsuh::where('tipe', 'Santri Luar')->where(function ($q) use ($search) {
            $q->orwhere('nama_lengkap', 'like', '%' . $this->search . '%')
                ->orwhere('tempat_lahir', 'like', '%' . $this->search . '%')
                ->orwhere('tanggal_lahir', 'like', '%' . $this->search . '%');
        });

        $childs = $query->orderBy('nama_lengkap', 'asc')->paginate(10);
        $count = $childs->count();

        $data =  [
            'childs' => $childs,
            'count' => $count
        ];

        return view('livewire.santri-luar', $data);
    }

    public function searchProduct()
    {
        $this->resetPage();
    }

    public function deleteConfirmation($id)
    {
        $this->idAnak = $id;
        $this->dispatchBrowserEvent('show-delete-confirmation');
    }

    public function destroy()
    {
        ModelsAnakAsuh::destroy($this->idAnak);

        $this->dispatchBrowserEvent('deleted', ['message' => 'Data Anak Asuh Berhasil Dihapus']);
    }

    public function exportExcel()
    {
        return Excel::download(new AnakAsuhExport, 'Data Anak Asuh.xlsx');
    }
}
