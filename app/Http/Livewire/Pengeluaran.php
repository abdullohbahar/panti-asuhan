<?php

namespace App\Http\Livewire;

use App\Models\Donation;
use Livewire\Component;

class Pengeluaran extends Component
{
    public $tanggal_donasi, $pengeluaran, $keterangan, $saldo;


    public function render()
    {
        $saldo = Donation::latest()->first();

        $data = [
            'saldo' => $saldo->saldo
        ];

        $this->saldo  = $saldo->saldo;
        return view('livewire.pengeluaran', $data);
    }

    public function rules()
    {
        return [
            'tanggal_donasi' => 'required',
            'pengeluaran' => 'required',
            'keterangan' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'tanggal_donasi.required' => 'Tanggal harus diisi',
            'pengeluaran.required' => 'Pengeluaran harus diisi',
            'keterangan.required' => 'Uraian harus diisi'
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

        $nominal = str_replace($removeChar, "", $this->pengeluaran);

        $nominal = str_replace(' ', '', $nominal);

        $donation = Donation::latest()->first();

        if ($nominal > $this->saldo) {
            $this->dispatchBrowserEvent('show-error');

            return false;
        }

        if ($donation != null) {
            $totalSaldo = $donation->saldo - $nominal;
        } else {
            $totalSaldo = $nominal;
        }

        Donation::create([
            'tanggal_donasi' => $this->tanggal_donasi,
            'pengeluaran' => $nominal,
            'jenis_donasi' => 'pengeluaran',
            'keterangan' => $this->keterangan,
            'saldo' => $totalSaldo
        ]);
    }
}
