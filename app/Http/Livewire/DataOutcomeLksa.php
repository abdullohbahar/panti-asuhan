<?php

namespace App\Http\Livewire;

use PDF;
use Livewire\Component;
use App\Models\LksaFinance;
use Livewire\WithPagination;
use App\Exports\ExpenseLksaExport;
use Maatwebsite\Excel\Facades\Excel;

class DataOutcomeLksa extends Component
{
    public $donatur_id, $pemasukan, $tanggal, $keterangan, $search, $date1, $date2, $filterDonaturId, $terbilang, $donation_id;

    protected $listeners = ['deleteConfirmed' => 'destroy'];
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $search = '';
        $date1 = '';
        $date2 = '';
        $filterDonaturId = '';

        $query = LksaFinance::where('transaksi', "pengeluaran")->when($this->date1, function ($query) use ($date1, $date2) {
            $query->whereBetween('tanggal', [$this->date1, $this->date2]);
        })->when(!empty($this->search), function ($query) {
            $query->where('keterangan', 'like', '%' . $this->search . '%');
        });

        $donations = $query->orderBy('tanggal', 'desc')->paginate(15);
        $count = $donations->count();

        $data = [
            'donations' => $donations,
            'count' => $count,
        ];

        return view('livewire.data-outcome-lksa', $data);
    }

    public function search()
    {
        $this->resetPage();
    }

    public function rules()
    {
        return [
            'pemasukan' => 'required',
            'tanggal' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'pemasukan.required' => 'Nominal harus diisi',
            'tanggal' => 'Tanggal harus diisi',
        ];
    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function show($id)
    {
        $donation = LksaFinance::find($id);

        if ($donation) {
            $this->donation_id = $donation->id;
            $this->pemasukan = "Rp. " . number_format($donation->pengeluaran, 0, '', '.');
            $this->tanggal = $donation->tanggal;
            $this->terbilang = $donation->terbilang;
            $this->keterangan = $donation->keterangan;
        }
    }

    public function update()
    {
        // Validate Data
        $validateData = $this->validate();

        // hapus character
        $removeChar = ['R', 'p', '.', ','];
        $pemasukan = str_replace($removeChar, "", $this->pemasukan);

        // Update data
        LksaFinance::where('id', $this->donation_id)->update([
            'pengeluaran' => $pemasukan,
            'tanggal' => $this->tanggal,
            'keterangan' => $this->keterangan,
            'terbilang' => $this->terbilang,
        ]);


        $this->dispatchBrowserEvent('close-modal', ['message' => 'Pengeluaran Berhasil Diubah']);
    }

    public function deleteConfirmation($id)
    {
        $this->donation_id = $id;
        $this->dispatchBrowserEvent('show-delete-confirmation');
    }

    public function destroy()
    {
        LksaFinance::destroy($this->donation_id);
        $this->dispatchBrowserEvent('deleted', ['message' => 'Pengeluaran Berhasil Dihapus']);
    }

    public function exportExcel()
    {
        return Excel::download(new ExpenseLksaExport, 'Pengeluaran LKSA.xlsx');
    }

    public function exportPdf()
    {
        $lksas = LksaFinance::where('transaksi', 'pengeluaran')->get();

        $data = [
            'lksas' => $lksas
        ];

        $pdf = PDF::loadView('export.pengeluaran-lksa.pdf', $data);
        $pdf->setPaper('F4', 'potrait');
        $pdf->setOptions(['dpi' => 96, 'defaultFont' => 'sans-serif']);

        return $pdf->download('Pengeluaran LKSA.pdf');
    }
}
