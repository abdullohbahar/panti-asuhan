<?php

namespace App\Http\Livewire;

use App\Models\AnakAsuh;
use App\Models\Donation;
use App\Models\Donatur;
use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        $data = [
            'anak_asuh' => AnakAsuh::count(),
            'total_donasi' => Donation::sum('nominal'),
            'total_donatur' => Donatur::count(),
            'total_tabungan' => 12412
        ];

        return view('livewire.dashboard', $data);
    }
}
