<?php

namespace App\Http\Livewire;

use App\Models\Donation;
use App\Models\Donatur;
use Livewire\Component;

class DonasiTunai extends Component
{
    public $donatur_id, $tanggal_donasi, $nominal, $terbilang, $keterangan, $tipe, $hajat;
    public function render()
    {
        $data = [
            'donaturs' => Donatur::get(),
        ];

        return view('livewire.donasi-tunai', $data);
    }

    public function rules()
    {
        return [
            'donatur_id' => 'required',
            'tanggal_donasi' => 'required',
            'nominal' => 'required',
            'terbilang' => 'required',
            'hajat' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'donatur_id.required' => 'Nama donatur harus diisi',
            'tanggal_donasi.required' => 'Tanggal sumbangan harus diisi',
            'nominal.required' => 'Nominal harus diisi',
            'terbilang.required' => 'Terbilang harus diisi',
            'hajat.required' => 'Hajat harus diisi',
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

        $nominal = str_replace($removeChar, "", $this->nominal);

        $nominal = str_replace(' ', '', $nominal);

        $donation = Donation::orderBy('no', 'desc')->first();


        if ($donation != null) {
            $no = str_pad($donation->no + 1, 5, 0, STR_PAD_LEFT);
            $totalSaldo = $donation->saldo + $nominal;
        } else {
            $no = '00001';
            $totalSaldo = $nominal;
        }

        Donation::create([
            'donatur_id' => $this->donatur_id,
            'no' => $no,
            'jenis_donasi' => 'Tunai',
            'terbilang' => $this->terbilang,
            'pemasukan' => $nominal,
            'saldo' => $totalSaldo,
            'keterangan' => $this->keterangan,
            'tipe' => $this->tipe,
            'hajat' => $this->hajat,
            'tanggal_donasi' => $this->tanggal_donasi,
        ]);
    }
}
