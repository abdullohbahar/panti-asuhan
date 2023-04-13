<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\LksaFinance;
use Livewire\WithPagination;
use App\Exports\IncomeLksaExport;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class DataIncomeLksa extends Component
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

        $query = LksaFinance::where('transaksi', "pemasukan")->when($this->date1, function ($query) use ($date1, $date2) {
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

        return view('livewire.data-income-lksa', $data);
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
            $this->pemasukan = "Rp. " . number_format($donation->pemasukan, 0, '', '.');
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
            'pemasukan' => $pemasukan,
            'tanggal' => $this->tanggal,
            'keterangan' => $this->keterangan,
            'terbilang' => $this->terbilang,
        ]);

        $this->dispatchBrowserEvent('close-modal', ['message' => 'Pemasukan Berhasil Diubah']);
    }

    public function deleteConfirmation($id)
    {
        $this->donation_id = $id;
        $this->dispatchBrowserEvent('show-delete-confirmation');
    }

    public function destroy()
    {
        LksaFinance::destroy($this->donation_id);
        $this->dispatchBrowserEvent('deleted', ['message' => 'Pemasukan Berhasil Dihapus']);
    }

    public function exportExcel()
    {
        return Excel::download(new IncomeLksaExport, 'Pemasukan LKSA.xlsx');
    }

    public function exportPdf()
    {
        $lksas = LksaFinance::where('transaksi', 'pemasukan')->get();

        $data = [
            'lksas' => $lksas
        ];

        $pdf = PDF::loadView('export.pemasukan-lksa.pdf', $data);
        $pdf->setPaper('F4', 'potrait');
        $pdf->setOptions(['dpi' => 96, 'defaultFont' => 'sans-serif']);

        return $pdf->download('Pemasukan LKSA.pdf');
    }
}
