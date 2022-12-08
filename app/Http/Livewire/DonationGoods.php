<?php

namespace App\Http\Livewire;

use App\Models\BuktiSumbangan;
use App\Models\Donation;
use App\Models\Donatur;
use Livewire\Component;
use Livewire\WithFileUploads;

class DonationGoods extends Component
{
    public $donation_id, $donatur_id, $tanggal_sumbangan, $keterangan, $search;
    public $donation_type_id = "Barang";
    public $nominal = 0;
    use WithFileUploads;

    public function render()
    {
        $search = '';

        $donaturs = Donatur::get();

        $query = Donation::where('donation_type_id', "Barang")->whereHas('donatur', function ($q) use ($search) {
            $q->where('nama', 'like', '%' . $this->search . '%')
                ->orwhere('tanggal_sumbangan', 'like', '%' . $this->search . '%')
                ->orwhere('keterangan', 'like', '%' . $this->search . '%');
        });

        $donations = $query->paginate(10);
        $count = $donations->count();

        $data = [
            'donaturs' => $donaturs,
            'donations' => $donations,
            'count' => $count
        ];

        return view('livewire.donation-goods', $data);
    }

    public function rules()
    {
        return [
            'donatur_id' => 'required',
            'donation_type_id' => 'required',
            'tanggal_sumbangan' => 'required',
            'keterangan' => 'required',
        ];
    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function store()
    {
        $validateData = $this->validate();

        Donation::create($validateData);

        $this->resetInput();
        $this->dispatchBrowserEvent('close-modal', ['message' => 'Donasi Berhasil Ditambahkan']);
    }

    public function resetInput()
    {
        $this->donatur_id = '';
        $this->nominal = '';
        $this->tanggal_sumbangan = '';
    }
}
