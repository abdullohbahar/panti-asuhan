<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\LetterYayasan;
use Illuminate\Support\Facades\Storage;

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

    public function download($downloadFile, $nama)
    {
        $ext = substr(strrchr($downloadFile, '.'), 1);
        return response()->download(public_path('storage/' . $downloadFile), $nama . '.' . $ext);
    }
}
