<?php

namespace App\Http\Livewire;

use App\Models\LksaFinance;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

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
        $monthBefore = $date->format('m');
        $year = $date->format('Y');
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
        })->where('transaksi', ['pemasukan', 'pengeluaran'])->orderBy('tanggal', 'asc');

        $time = strtotime($this->date1);
        $monthNow = date("m", $time);
        $year = date("Y", $time);

        if ($monthNow == 01) {
            $monthBefore = 12;
            $year = $year - 1;
        } else {
            $monthBefore = $monthNow - 1;
        }

        $pemasukanBulanSebelumnya = LksaFinance::whereMonth('tanggal', $monthBefore)->whereYear("tanggal", $year)->sum("pemasukan");
        $pengeluaranBulanSebelumnya = LksaFinance::whereMonth('tanggal', $monthBefore)->whereYear("tanggal", $year)->sum("pengeluaran");

        $saldoBulanSebelumnya = $pemasukanBulanSebelumnya - $pengeluaranBulanSebelumnya;

        $data = [
            'donations' => $query->get(),
            'pemasukan' => $query->sum('pemasukan'),
            'pengeluaran' => $query->sum('pengeluaran'),
            'saldoBulanSebelumnya' => $saldoBulanSebelumnya
        ];


        // dd($data);

        // return view('cetak-laporan-pemasukan-pengeluaran-pdf', $data);

        $pdf = PDF::loadView('cetak-laporan-pemasukan-pengeluaran-pdf', $data);
        $pdf->setPaper('F4', 'potrait');
        $pdf->setOptions(['dpi' => 96, 'defaultFont' => 'sans-serif']);


        return $pdf->download('LAPORAN KEUANGAN.pdf');
    }
}
