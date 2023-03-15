<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Exports\PengurusExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Pengurus as ModelsPengurus;
use PDF;

class Pengurus extends Component
{
    public $search, $idPengurus;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['deleteConfirmed' => 'destroy'];


    public function render()
    {
        $search = '';

        $penguruses = ModelsPengurus::where(function ($q) use ($search) {
            $q->orwhere('nama', 'like', '%' . $this->search . '%')
                ->orwhere('jabatan', 'like', '%' . $this->search . '%');
        })->orderBy('order', 'asc')->get();

        $data =  [
            'penguruses' => $penguruses,
        ];

        return view('livewire.pengurus', $data);
    }

    public function updatePengurusOrder($list)
    {
        foreach ($list as $item) {
            ModelsPengurus::find($item['value'])->update(['order' => $item['order']]);
        }
    }

    public function deleteConfirmation($id)
    {
        $this->idPengurus = $id;
        $this->dispatchBrowserEvent('show-delete-confirmation');
    }

    public function destroy()
    {
        ModelsPengurus::destroy($this->idPengurus);

        $this->dispatchBrowserEvent('deleted', ['message' => 'Data Pengurus Berhasil Dihapus']);
    }

    public function exportExcel()
    {
        return Excel::download(new PengurusExport, 'Data Pengurus.xlsx');
    }

    public function exportPdf()
    {
        $penguruses = ModelsPengurus::get();

        $data = [
            'penguruses' => $penguruses
        ];

        // return view('export.pengurus.pdf', $data);

        $pdf = PDF::loadView('export.pengurus.pdf', $data);
        $pdf->setPaper('F4', 'potrait');
        $pdf->setOptions(['dpi' => 96, 'defaultFont' => 'sans-serif']);

        return $pdf->download('Data Pengurus.pdf');
    }
}
