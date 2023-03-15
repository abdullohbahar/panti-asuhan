<?php

namespace App\Http\Livewire;

use App\Models\LetterYayasan;
use Livewire\Component;

class DataIncomingLetterYayasan extends Component
{
    public $search;

    public function render()
    {
        $search = '';

        $letters = LetterYayasan::where('tipe', 'Surat Masuk')->when(!empty($this->search), function ($query) {
            $query->where('nama_surat', 'like', "%$this->search%");
        })->paginate(20);

        $data = [
            'letters' => $letters
        ];

        return view('livewire.data-incoming-letter-yayasan', $data);
    }
}
