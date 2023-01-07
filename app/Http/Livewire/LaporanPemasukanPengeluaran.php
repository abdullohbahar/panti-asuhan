<?php

namespace App\Http\Livewire;

use App\Exports\LaporanPemasukanPengeluaranExport;
use App\Models\Donatur;
use Livewire\Component;
use App\Models\Donation;
use PDF;
use Livewire\WithPagination;
use App\Models\TotalDanaDonation;
use Maatwebsite\Excel\Facades\Excel;


class LaporanPemasukanPengeluaran extends Component
{
    public $search, $date1, $date2;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $search = '';
        $date1 = '';
        $date2 = '';

        $query = Donation::whereBetween('tanggal_donasi', [$this->date1, $this->date2])
            ->orderBy('tanggal_donasi', 'asc');

        $donations = $query->get();
        $count = $donations->count();

        $time = strtotime($this->date1);
        $monthNow = date("m", $time);
        $year = date("Y", $time);

        if ($monthNow == 01) {
            $monthBefore = 12;
            $year = $year - 1;
        } else {
            $monthBefore = $monthNow - 1;
        }

        $pemasukanBulanSebelumnya = Donation::whereMonth('tanggal_donasi', $monthBefore)->whereYear("tanggal_donasi", $year)->sum("pemasukan");
        $pengeluaranBulanSebelumnya = Donation::whereMonth('tanggal_donasi', $monthBefore)->whereYear("tanggal_donasi", $year)->sum("pengeluaran");

        $saldoBulanSebelumnya = $pemasukanBulanSebelumnya - $pengeluaranBulanSebelumnya;

        $data = [
            'donations' => $donations,
            'count' => $count,
            'date1' => $this->date1,
            'date2' => $this->date2,
            'saldoBulanSebelumnya' => $saldoBulanSebelumnya
        ];

        return view('livewire.laporan-pemasukan-pengeluaran', $data);
    }

    public function search()
    {
        $this->resetPage();
    }

    public function printPDFLaporan($date1, $date2)
    {
        $query = Donation::when($date1 != 0, function ($query) use ($date1, $date2) {
            $query->whereBetween('tanggal_donasi', [$date1, $date2]);
        })->where('jenis_donasi', '=', "Tunai")->orWhere('jenis_donasi', '=', 'pengeluaran')->orWhere('jenis_donasi', '=', 'transfer');

        $data = [
            'donations' => $query->get(),
            'pemasukan' => $query->sum('pemasukan'),
            'pengeluaran' => $query->sum('pengeluaran'),
        ];


        // dd($data);

        // return view('cetak-laporan-pemasukan-pengeluaran-pdf', $data);

        $pdf = PDF::loadView('cetak-laporan-pemasukan-pengeluaran-pdf', $data);
        $pdf->setPaper('F4', 'potrait');
        $pdf->setOptions(['dpi' => 96, 'defaultFont' => 'sans-serif']);


        return $pdf->download('LAPORAN KEUANGAN.pdf');
    }

    public function exportExcel($date1, $date2)
    {
        return Excel::download(new LaporanPemasukanPengeluaranExport($date1, $date2), 'Laporan Keuangan.xlsx');
    }
}
