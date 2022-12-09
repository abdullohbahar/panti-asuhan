<?php

namespace App\Http\Livewire;

use App\Models\Donation as ModelsDonation;
use App\Models\Donatur;
use Livewire\Component;

class Donation extends Component
{
    public $donation_id, $donatur_id, $nominal, $tanggal_sumbangan, $keterangan, $search;
    public $donation_type_id = "Dana";
    protected $listeners = ['deleteConfirmed' => 'destroy'];

    public function render()
    {
        $search = '';

        $donaturs = Donatur::get();

        $query = ModelsDonation::where('donation_type_id', "Dana")->whereHas('donatur', function ($q) use ($search) {
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

        return view('livewire.donation', $data);
    }

    public function rules()
    {
        return [
            'donatur_id' => 'required',
            'donation_type_id' => 'required',
            'nominal' => 'required',
            'tanggal_sumbangan' => 'required',
            'keterangan' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'nominal.required' => 'Nominal harus diisi'
        ];
    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function store()
    {
        $validateData = $this->validate();

        ModelsDonation::create($validateData);
        $this->resetInput();
        $this->dispatchBrowserEvent('close-modal', ['message' => 'Donasi Berhasil Ditambahkan']);
    }

    public function resetInput()
    {
        $this->donatur_id = '';
        $this->nominal = '';
        $this->tanggal_sumbangan = '';
    }

    public function show($id)
    {
        $donation = ModelsDonation::find($id);

        if ($donation) {
            $this->donation_id = $donation->id;
            $this->donatur_id = $donation->donatur_id;
            $this->nominal = $donation->nominal;
            $this->tanggal_sumbangan = $donation->tanggal_sumbangan;
            $this->keterangan = $donation->keterangan;
        }
    }

    public function update()
    {
        $validateData = $this->validate();

        ModelsDonation::where('id', $this->donation_id)->update([
            'donatur_id' => $this->donatur_id,
            'nominal' => $this->nominal,
            'tanggal_sumbangan' => $this->tanggal_sumbangan,
            'keterangan' => $this->keterangan,
        ]);

        $this->dispatchBrowserEvent('close-modal', ['message' => 'Donasi Berhasil Diubah']);
    }

    public function deleteConfirmation($id)
    {
        $this->donation_id = $id;
        $this->dispatchBrowserEvent('show-delete-confirmation');
    }

    public function destroy()
    {
        ModelsDonation::destroy($this->donation_id);
        $this->dispatchBrowserEvent('deleted', ['message' => 'Donasi Berhasil Dihapus']);
    }
}
