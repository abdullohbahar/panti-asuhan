<?php

namespace App\Http\Livewire;

use App\Models\Donatur;
use Livewire\Component;
use App\Models\Donation;
use PDF;
use Livewire\WithPagination;
use App\Models\TotalDanaDonation;

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

        $query = Donation::when($this->date1, function ($query) use ($date1, $date2) {
            $query->whereBetween('tanggal_donasi', [$this->date1, $this->date2]);
        })->where('jenis_donasi', '=', "Tunai")->orWhere('jenis_donasi', '=', 'pengeluaran')->orWhere('jenis_donasi', '=', 'transfer');

        $donations = $query->get();
        $count = $donations->count();

        $data = [
            'donations' => $donations,
            'count' => $count,
            'date1' => $this->date1,
            'date2' => $this->date2,
            'pemasukan' => $query->sum('pemasukan'),
            'pengeluaran' => $query->sum('pengeluaran'),
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
}
