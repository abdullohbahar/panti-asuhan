<?php

namespace App\Http\Livewire;

use PDF;
use Carbon\Carbon;
use App\Models\Donatur;
use Livewire\Component;
use App\Models\Donation;
use Livewire\WithPagination;
use App\Models\TotalDanaDonation;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\LaporanPemasukanPengeluaranExport;


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

        $query = Donation::with('donaturName')->whereBetween('tanggal_donasi', [$this->date1, $this->date2])
            ->orderBy('tanggal_donasi', 'asc');

        $donations = $query->get();
        $count = $donations->count();

        $date = Carbon::parse($this->date1)->subMonth();
        $monthBefore = $date->format('m');
        $year = $date->format('Y');
        $subMonth = $date->lastOfMonth()->format('Y-m-d');

        $pemasukanBulanSebelumnya = Donation::whereBetween('tanggal_donasi', ['2000-01-01', $subMonth])->sum("pemasukan");
        $pengeluaranBulanSebelumnya = Donation::whereBetween('tanggal_donasi', ['2000-01-01', $subMonth])->sum("pengeluaran");

        $saldoBulanSebelumnya = $pemasukanBulanSebelumnya - $pengeluaranBulanSebelumnya;

        // dd($donations);

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
        $image_path = public_path('logo/kop.png');

        $image_data = base64_encode(file_get_contents($image_path));

        $query = Donation::when($date1 != 0, function ($query) use ($date1, $date2) {
            $query->whereBetween('tanggal_donasi', [$date1, $date2]);
        })->where('jenis_donasi', '=', "Tunai")->orWhere('jenis_donasi', '=', 'pengeluaran')->orWhere('jenis_donasi', '=', 'transfer')->orderBy('tanggal_donasi', 'asc');

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
            'donations' => $query->get(),
            'pemasukan' => $query->sum('pemasukan'),
            'pengeluaran' => $query->sum('pengeluaran'),
            'saldoBulanSebelumnya' => $saldoBulanSebelumnya,
            'image' => $image_data,
        ];


        // dd($data);

        // return view('cetak-laporan-pemasukan-pengeluaran-pdf', $data);

        $pdf = PDF::loadView('cetak-laporan-pemasukan-pengeluaran-pdf', $data);
        $pdf->setPaper('F4', 'potrait');
        $pdf->setOptions(['dpi' => 96, 'defaultFont' => 'sans-serif']);


        return $pdf->download('Laporan pemasukan pengeluaran Yayasan.pdf');
    }

    public function exportExcel($date1, $date2)
    {
        return Excel::download(new LaporanPemasukanPengeluaranExport($date1, $date2), 'Laporan pemasukan pengeluaran Yayasan.xlsx');
    }
}
