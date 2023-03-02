<?php

namespace App\Http\Livewire;

use App\Models\Citizen;
use Livewire\Component;

class ProfileWarga extends Component
{
    public $idwarga;

    public function render()
    {
        $search = '';

        $citizen = Citizen::find($this->idwarga);
        // $documents = ChildDocument::where('anak_asuh_id', $this->idwarga)
        //     ->when(!empty($this->search), function ($q) use ($search) {
        //         $q->where('nama_dokumen', 'like', "%{$this->search}%");
        //     })
        //     ->get();

        $data = [
            'citizen' => $citizen,
            // 'documents' => $documents
        ];

        return view('livewire.profile-warga', $data);
    }
}
