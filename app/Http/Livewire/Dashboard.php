<?php

namespace App\Http\Livewire;

use App\Models\AnakAsuh;
use App\Models\Donation;
use App\Models\Donatur;
use App\Models\GoodsDonation;
use App\Models\LksaFinance;
use App\Models\Pengurus;
use App\Models\Saving;
use App\Models\TotalDanaDonation;
use Carbon\Carbon;
use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        $monthNow = Carbon::now()->format('m');
        $yearNow = Carbon::now()->format('Y');
        $data = [
            'santriDalam' => AnakAsuh::where('tipe', 'Santri Dalam')->count(),
            'total_donasi' => TotalDanaDonation::sum('total'),
            'total_donatur' => Donatur::count(),
            'total_tabungan' => Saving::sum('total_tabungan'),
            'pengurus' => Pengurus::count(),
            'santriLuar' => AnakAsuh::where('tipe', 'Santri Luar')->count(),
            'donasiTunai' => Donation::where('jenis_donasi', 'Tunai')->whereMonth('tanggal_donasi', $monthNow)->whereYear('tanggal_donasi', $yearNow)->sum('pemasukan'),
            'donasiTransfer' => Donation::where('jenis_donasi', 'Transfer')->whereMonth('tanggal_donasi', $monthNow)->whereYear('tanggal_donasi', $yearNow)->sum('pemasukan'),
            'pengeluaran' => Donation::where('jenis_donasi', 'pengeluaran')->whereMonth('tanggal_donasi', $monthNow)->whereYear('tanggal_donasi', $yearNow)->sum('pengeluaran'),
            'donasiBarang' => GoodsDonation::count(),
            'pemaskuanLKSA' => LksaFinance::whereMonth('tanggal', $monthNow)->whereYear('tanggal', $yearNow)->sum('pemasukan'),
            'pengeluaranLKSA' => LksaFinance::whereMonth('tanggal', $monthNow)->whereYear('tanggal', $yearNow)->sum('pengeluaran'),
        ];

        return view('livewire.dashboard', $data);
    }
}
