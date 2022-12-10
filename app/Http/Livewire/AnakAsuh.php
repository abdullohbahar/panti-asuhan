<?php

namespace App\Http\Livewire;

use App\Models\AnakAsuh as ModelsAnakAsuh;
use Livewire\Component;
use Livewire\WithFileUploads;

class AnakAsuh extends Component
{
    use WithFileUploads;
    public $search, $idAnak, $foto, $nama_lengkap, $jenis_kelamin, $tempat_lahir, $tanggal_lahir, $alamat, $keterangan, $status, $akta, $kartu_keluarga, $nama_ayah_kandung, $nama_ibu_kandung, $nohp_ortu;
    protected $listeners = ['deleteConfirmed' => 'destroy'];

    public function render()
    {
        $search = '';

        $query = ModelsAnakAsuh::where(function ($q) use ($search) {
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

        return view('livewire.anak-asuh', $data);
    }

    public function deleteConfirmation($id)
    {
        $this->idAnak = $id;
        $this->dispatchBrowserEvent('show-delete-confirmation');
    }

    public function destroy()
    {
        $anak = ModelsAnakAsuh::find($this->idAnak);

        if ($anak->foto) {
            unlink(public_path('storage/' . $anak->foto));
        }

        if ($anak->kartu_keluarga) {
            unlink(public_path('storage/' . $anak->kartu_keluarga));
        }

        if ($anak->akta) {
            unlink(public_path('storage/' . $anak->akta));
        }

        ModelsAnakAsuh::destroy($this->idAnak);

        $this->dispatchBrowserEvent('deleted', ['message' => 'Data Anak Asuh Berhasil Dihapus']);
    }
}
