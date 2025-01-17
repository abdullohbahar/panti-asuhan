<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\LksaFinance;
use App\Exports\IncomeLksaExport;
use Maatwebsite\Excel\Facades\Excel;

class IncomeLksa extends Component
{
    public $tanggal, $pemasukan, $keterangan, $saldo, $date1, $date2, $filterDonaturId, $terbilang;

    public function render()
    {
        $now = Carbon::now();
        $month = $now->month;
        $year = $now->year;

        $query = LksaFinance::whereMonth('tanggal', $month)->whereYear('tanggal', $year);

        $pemasukan = $query->sum('pemasukan');
        $pengeluaran = $query->sum('pengeluaran');

        $saldo = $pemasukan - $pengeluaran;

        $this->saldo = $saldo;

        $data = [
            'totalSaldo' => $saldo,
        ];

        return view('livewire.income-lksa', $data);
    }

    public function rules()
    {
        return [
            'tanggal' => 'required',
            'pemasukan' => 'required',
            'keterangan' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'tanggal.required' => 'Tanggal harus diisi',
            'pemasukan.required' => 'Nominal harus diisi',
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

        $nominal = str_replace($removeChar, "", $this->pemasukan);

        $nominal = str_replace(' ', '', $nominal);

        $donation = LksaFinance::orderBy('urutan', 'desc')->first();

        LksaFinance::create([
            'tanggal' => $this->tanggal,
            'pemasukan' => $nominal,
            'terbilang' => $this->terbilang,
            'jenis_donasi' => 'pemasukan',
            'keterangan' => $this->keterangan,
            'transaksi' => 'pemasukan'
        ]);

        return redirect()->route('data.income.lksa')->with('message', 'Data berhasil ditambahkan');
    }
}
