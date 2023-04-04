<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Pengurus;
use Livewire\WithPagination;
use App\Exports\PengurusExport;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

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

    public function exportExcel()
    {
        return Excel::download(new PengurusExport('Pengurus Meninggal'), 'Data Pengurus Meninggal.xlsx');
    }

    public function exportPdf()
    {
        $penguruses = Pengurus::where('status', 'Pengurus Meninggal')->get();

        $data = [
            'penguruses' => $penguruses
        ];

        // return view('export.pengurus.pdf', $data);

        $pdf = PDF::loadView('export.pengurus.pdf', $data);
        $pdf->setPaper('F4', 'potrait');
        $pdf->setOptions(['dpi' => 96, 'defaultFont' => 'sans-serif']);

        return $pdf->download('Data Pengurus Meninggal.pdf');
    }
}
