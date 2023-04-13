<?php

namespace App\Http\Livewire;

use App\Exports\IncomeAndExpenseExport;
use App\Models\LksaFinance;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;
use PDF;
use Maatwebsite\Excel\Facades\Excel;



class IncomeAndExpenseReport extends Component
{
    public $search, $date1, $date2;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $search = '';
        $date1 = '';
        $date2 = '';

        $query = LksaFinance::whereBetween('tanggal', [$this->date1, $this->date2])
            ->orderBy('tanggal', 'asc');

        $donations = $query->get();
        $count = $donations->count();

        $date = Carbon::parse($this->date1)->subMonth();
        $subMonth = $date->lastOfMonth()->format('Y-m-d');

        $pemasukanBulanSebelumnya = LksaFinance::whereBetween('tanggal', ['2000-01-01', $subMonth])->sum("pemasukan");
        $pengeluaranBulanSebelumnya = LksaFinance::whereBetween('tanggal', ['2000-01-01', $subMonth])->sum("pengeluaran");

        $saldoBulanSebelumnya = $pemasukanBulanSebelumnya - $pengeluaranBulanSebelumnya;

        // dd($donations);

        $data = [
            'donations' => $donations,
            'count' => $count,
            'date1' => $this->date1,
            'date2' => $this->date2,
            'saldoBulanSebelumnya' => $saldoBulanSebelumnya
        ];

        return view('livewire.income-and-expense-report', $data);
    }

    public function search()
    {
        $this->resetPage();
    }

    public function printPDFLaporan($date1, $date2)
    {
        $query = LksaFinance::when($date1 != 0, function ($query) use ($date1, $date2) {
            $query->whereBetween('tanggal', [$date1, $date2]);
        })->orderBy('tanggal', 'asc');

        $date = Carbon::parse($date1)->subMonth();
        $subMonth = $date->lastOfMonth()->format('Y-m-d');

        $pemasukanBulanSebelumnya = LksaFinance::whereBetween('tanggal', ['2000-01-01', $subMonth])->sum("pemasukan");
        $pengeluaranBulanSebelumnya = LksaFinance::whereBetween('tanggal', ['2000-01-01', $subMonth])->sum("pengeluaran");

        $saldoBulanSebelumnya = $pemasukanBulanSebelumnya - $pengeluaranBulanSebelumnya;

        $image_path = public_path('logo/kop.png');

        $image_data = base64_encode(file_get_contents($image_path));

        $data = [
            'donations' => $query->get(),
            'pemasukan' => $query->sum('pemasukan'),
            'pengeluaran' => $query->sum('pengeluaran'),
            'saldoBulanSebelumnya' => $saldoBulanSebelumnya,
            'image' => $image_data,
        ];

        $pdf = PDF::loadView('cetak-laporan-pemasukan-pengeluaran-pdf-lksa', $data);
        $pdf->setPaper('F4', 'potrait');
        $pdf->setOptions(['dpi' => 96, 'defaultFont' => 'sans-serif']);


        return $pdf->download('Laporan pemasukan pengeluaran LKSA.pdf');
    }

    public function exportExcel($date1, $date2)
    {
        return Excel::download(new IncomeAndExpenseExport($date1, $date2), 'Laporan pemasukan pengeluaran LKSA.xlsx');
    }

    public function downloadTemplate()
    {
        return response()->download(public_path('template/import/template import keuangan LKSA.xlsx'));
    }
}
