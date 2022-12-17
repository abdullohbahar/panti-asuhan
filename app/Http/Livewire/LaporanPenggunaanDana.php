<?php

namespace App\Http\Livewire;

use App\Exports\ReportFundExport;
use App\Models\ReportFund;
use App\Models\TotalDanaDonation;
use Livewire\Component;
use Livewire\WithPagination;

class LaporanPenggunaanDana extends Component
{
    public $nominal, $keterangan, $tanggal, $idReport, $date1, $date2;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $date1 = '';
        $date2 = '';

        $query = ReportFund::when($this->date1, function ($query) use ($date1, $date2) {
            $query->whereBetween('tanggal', [$this->date1, $this->date2]);
        });

        $reports = $query->paginate(10);
        $totalDonation = TotalDanaDonation::first();
        $count = $reports->count();

        $data = [
            'reports' => $reports,
            'totalDana' => $totalDonation,
            'count' => $count
        ];

        return view('livewire.laporan-penggunaan-dana', $data);
    }

    public function rules()
    {
        return [
            'nominal' => 'required',
            'keterangan' => 'required',
            'tanggal' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'nominal.required' => 'Nominal harus diisi',
            'keterangan.required' => 'Keterangan harus diisi',
            'tanggal.required' => 'Tanggal harus diisi'
        ];
    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function store()
    {
        dd($this->tanggal);
        $this->validate();

        $removeChar = ['R', 'p', '.', ','];

        $nominal = str_replace($removeChar, "", $this->nominal);

        ReportFund::create([
            'nominal' => $nominal,
            'keterangan' => $this->keterangan,
            'tanggal' => $this->tanggal,
        ]);

        $totalDana = TotalDanaDonation::first();

        $total = $totalDana->total - $nominal;

        TotalDanaDonation::where('id', 1)->update([
            'total' => $total
        ]);

        $this->resetInput();
        $this->dispatchBrowserEvent('close-modal', ['message' => 'Laporan Donasi Berhasil Ditambahkan']);
    }

    public function resetInput()
    {
        $this->nominal = '';
        $this->keterangan = '';
        $this->tanggal = '';
    }

    public function show($id)
    {
        $report = ReportFund::find($id);

        if ($report) {
            $this->idReport = $report->id;
            $this->nominal = "Rp " . number_format($report->nominal, 0, '', '.');
            $this->keterangan = $report->keterangan;
            $this->tanggal = $report->tanggal;
        }
    }

    public function update()
    {
        $this->validate();

        $removeChar = ['R', 'p', '.', ','];

        $nominal = str_replace($removeChar, "", $this->nominal);

        $getNominal = ReportFund::find($this->idReport);
        $getTotalDana = TotalDanaDonation::find(1);

        ReportFund::where('id', $this->idReport)->update([
            'nominal' => $nominal,
            'keterangan' => $this->keterangan,
            'tanggal' => $this->tanggal,
        ]);

        $count = $getTotalDana->total + $getNominal->nominal;
        $total = $count - $nominal;

        TotalDanaDonation::where('id', 1)->update([
            'total' => $total
        ]);

        $this->resetInput();
        $this->dispatchBrowserEvent('close-modal', ['message' => 'Laporan Donasi Berhasil Diubah']);
    }

    public function filter()
    {
        $this->resetPage();
    }

    public function print()
    {
        $date1 = '';
        $date2 = '';

        $query = ReportFund::when($this->date1, function ($query) use ($date1, $date2) {
            $query->whereBetween('tanggal', [$this->date1, $this->date2]);
        });

        $reports = $query->get();

        $total = $query->sum('nominal');


        $data = [
            'reports' => $reports,
            'total' => $total
        ];

        // dd($data);

        // return view('cetak-donasi-dana', $data);

        $pdf = PDF::loadView('cetak-donasi-dana', $data);

        return $pdf->download('Laporan Donasi.pdf');
    }

    public function exportExcel()
    {
        return (new ReportFundExport)->download('Laporan Penggunaan Dana.xlsx');
    }
}
