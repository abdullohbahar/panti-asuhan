<?php

namespace App\Http\Livewire;

use PDF;
use Carbon\Carbon;
use Livewire\Component;
use App\Models\Donation;

class Pengeluaran extends Component
{
    public $tanggal_donasi, $pengeluaran, $keterangan, $saldo, $date1, $date2, $filterDonaturId;


    public function render()
    {
        $now = Carbon::now();
        $month = $now->month;
        $year = $now->year;

        $query = Donation::whereMonth('tanggal_donasi', $month)->whereYear('tanggal_donasi', $year);

        $pemasukan = $query->sum('pemasukan');
        $pengeluaran = $query->sum('pengeluaran');

        $saldo = $pemasukan - $pengeluaran;

        $this->saldo = $saldo;

        $data = [
            'totalSaldo' => $saldo,
        ];

        return view('livewire.pengeluaran', $data);
    }

    public function rules()
    {
        return [
            'tanggal_donasi' => 'required',
            'pengeluaran' => 'required',
            'keterangan' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'tanggal_donasi.required' => 'Tanggal harus diisi',
            'pengeluaran.required' => 'Pengeluaran harus diisi',
            'keterangan.required' => 'Uraian harus diisi'
        ];
    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function store()
    {
        $this->validate();

        $removeChar = ['R', 'p', '.', ','];

        $nominal = str_replace($removeChar, "", $this->pengeluaran);

        $nominal = str_replace(' ', '', $nominal);

        $donation = Donation::orderBy('urutan', 'desc')->first();

        Donation::create([
            'tanggal_donasi' => $this->tanggal_donasi,
            'pengeluaran' => $nominal,
            'jenis_donasi' => 'pengeluaran',
            'keterangan' => $this->keterangan,
            'transaksi' => 'pengeluaran',
            'penerima' => ' '
        ]);

        $this->dispatchBrowserEvent('close-modal', ['message' => 'Berhasil']);
    }

    public function print()
    {
        $search = '';
        $date1 = '';
        $date2 = '';
        $filterDonaturId = '';

        $query = Donation::where('jenis_donasi', '=', "Tunai")->orWhere('jenis_donasi', '=', 'pengeluaran')
            ->when($this->date1, function ($query) use ($date1, $date2) {
                $query->whereBetween('tanggal_donasi', [$this->date1, $this->date2]);
            })->when($this->filterDonaturId, function ($query) use ($filterDonaturId) {
                $query->whereHas('donatur', function ($query) use ($filterDonaturId) {
                    $query->where('id', $this->filterDonaturId);
                });
            });

        $data = [
            'donations' => $query->get(),
            'pemasukan' => $query->sum('pemasukan'),
            'pengeluaran' => $query->sum('pengeluaran'),
            'saldo' => $query->orderBy('urutan', 'desc')->first()
        ];

        // dd($data);

        return view('cetak-laporan-pemasukan-pengeluaran-pdf', $data);

        // $pdf = PDF::loadView('cetak-laporan-pemasukan-pengeluaran-pdf', $data);
        // $pdf->setPaper('F4', 'potrait');
        // $pdf->setOptions(['dpi' => 96, 'defaultFont' => 'sans-serif']);

        return $pdf->download('LAPORAN KEUANGAN.pdf');
    }

    public function exportExcel()
    {
        return (new DonationExport)->download('Laporan Donasi.xlsx');
    }
}
