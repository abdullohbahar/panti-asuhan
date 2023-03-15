<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\LetterYayasan;

class DataOutcomeLetterYayasan extends Component
{
    public $search;
    public $file;
    public $nomor_surat;
    public $nama_surat;
    public $tipe;
    public $keterangan;
    public $idLetter;

    public function render()
    {
        $search = '';

        $letters = LetterYayasan::where('tipe', 'Surat Keluar')->when(!empty($this->search), function ($query) {
            $query->where('nama_surat', 'like', "%$this->search%");
        })->paginate(20);

        $data = [
            'letters' => $letters
        ];

        return view('livewire.data-outcome-letter-yayasan', $data);
    }

    public function download($downloadFile, $nama)
    {
        $ext = substr(strrchr($downloadFile, '.'), 1);
        return response()->download(public_path('storage/' . $downloadFile), $nama . '.' . $ext);
    }
}
