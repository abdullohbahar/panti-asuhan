<?php

namespace App\Http\Livewire;

use App\Models\AnakAsuh;
use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        $data = [
            'anak_asuh' => AnakAsuh::count(),
        ];

        return view('livewire.dashboard', $data);
    }
}
