<?php

namespace App\Http\Livewire;

use App\Models\TotalDanaDonation;
use App\Models\Donation;
use App\Models\Donatur;
use Livewire\Component;
use Livewire\WithPagination;

class LaporanPemasukanPengeluaran extends Component
{
    public $donation_id, $donatur_id, $pemasukan, $tanggal_sumbangan, $keterangan, $search, $date1, $date2, $filterDonaturId;
    public $donation_type_id = "Dana";
    protected $listeners = ['deleteConfirmed' => 'destroy'];
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function render()
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

        $donations = $query->paginate(10);
        $count = $donations->count();

        $data = [
            'donations' => $donations,
            'count' => $count,
        ];

        return view('livewire.laporan-pemasukan-pengeluaran', $data);
    }
}
