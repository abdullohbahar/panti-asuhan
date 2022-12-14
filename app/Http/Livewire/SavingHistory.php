<?php

namespace App\Http\Livewire;

use App\Models\Saving;
use App\Models\SavingHistory as ModelsSavingHistory;
use Livewire\Component;

class SavingHistory extends Component
{
    public $idsaving, $nominal, $status, $tanggal;

    public function render()
    {
        $query = ModelsSavingHistory::where('saving_id', $this->idsaving)->get();
        $saldo = Saving::find($this->idsaving)->total_tabungan;

        $data = [
            'savings' => $query,
            'saldo' => $saldo
        ];

        return view('livewire.saving-history', $data);
    }

    public function rules()
    {
        return [
            'nominal' => 'required',
            'status' => 'required',
            'tanggal' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'nominal.required' => 'Nominal harus diisi',
            'status.required' => 'Status harus diisi',
            'tanggal.required' => 'Tanggal harus diisi',
        ];
    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function store()
    {
        $validateData = $this->validate();

        $saldo = Saving::find($this->idsaving);

        $removeChar = ['R', 'p', '.', ','];

        $validateData['nominal'] = str_replace($removeChar, "", $validateData['nominal']);

        $nominal = str_replace(' ', '', $validateData['nominal']);

        $anakAsuhId = $saldo->anak_asuh_id;

        if ($this->status == 'Mengambil') {
            if ($nominal >= $saldo->total_tabungan) {
                $this->dispatchBrowserEvent('show-error');
            } else {
                ModelsSavingHistory::create([
                    'anak_asuh_id' => $anakAsuhId,
                    'saving_id' => $this->idsaving,
                    'tanggal' => $this->tanggal,
                    'mengambil' => $nominal,
                    'saldo' => $saldo->total_tabungan - $nominal,
                ]);
                $totalSaldo = $saldo->total_tabungan - $nominal;

                Saving::where('id', $this->idsaving)->update([
                    'total_tabungan' => $totalSaldo
                ]);

                $this->dispatchBrowserEvent('close-modal', ['message' => 'Berhasil ' . $this->status]);
            }
        } else {
            ModelsSavingHistory::create([
                'anak_asuh_id' => $anakAsuhId,
                'saving_id' => $this->idsaving,
                'tanggal' => $this->tanggal,
                'menabung' => $nominal,
                'saldo' => $saldo->total_tabungan + $nominal,
            ]);

            $totalSaldo = $saldo->total_tabungan + $nominal;

            Saving::where('id', $this->idsaving)->update([
                'total_tabungan' => $totalSaldo
            ]);

            $this->dispatchBrowserEvent('close-modal', ['message' => 'Berhasil ' . $this->status]);
        }
    }
}
