<?php

namespace App\Http\Livewire;

use App\Models\AnakAsuh;
use App\Models\Donation;
use App\Models\Donatur;
use App\Models\Pengurus;
use App\Models\Saving;
use App\Models\TotalDanaDonation;
use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        $data = [
            'anak_asuh' => AnakAsuh::count(),
            'total_donasi' => TotalDanaDonation::sum('total'),
            'total_donatur' => Donatur::count(),
            'total_tabungan' => Saving::sum('total_tabungan'),
            'pengurus' => Pengurus::count(),
        ];

        return view('livewire.dashboard', $data);
    }
}
