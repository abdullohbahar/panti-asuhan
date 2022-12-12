<?php

namespace App\Http\Livewire;

use App\Models\BuktiSumbangan;
use App\Models\Donation;
use App\Models\Donatur;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class DonationGoods extends Component
{
    use WithFileUploads;

    public $donation_id, $donatur_id, $tanggal_sumbangan, $keterangan, $search, $jumlah, $satuan;
    public $donation_type_id = "Barang";
    public $nominal = "0";
    protected $listeners = ['deleteConfirmed' => 'destroy'];


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
            'nominal' => 'required',
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

        Donation::create([
            'donatur_id' => $this->donatur_id,
            'donation_type_id' => $this->donation_type_id,
            'tanggal_sumbangan' => $this->tanggal_sumbangan,
            'nominal' => $this->nominal,
            'keterangan' => $this->keterangan,
            'jumlah' => $this->jumlah . " " . $this->satuan,
        ]);

        $this->resetInput();
        $this->dispatchBrowserEvent('close-modal', ['message' => 'Donasi Berhasil Ditambahkan']);
    }

    public function resetInput()
    {
        $this->donatur_id = '';
        $this->tanggal_sumbangan = '';
        $this->keterangan = '';
        $this->jumlah = '';
        $this->satuan = '';
    }

    public function show($id)
    {
        $donation = Donation::find($id);

        if ($donation) {
            $word = explode(" ", $donation->jumlah);

            $this->donation_id = $donation->id;
            $this->donatur_id = $donation->donatur_id;
            $this->tanggal_sumbangan = $donation->tanggal_sumbangan;
            $this->keterangan = $donation->keterangan;
            $this->jumlah = $word[0];
            $this->satuan = $word[1];
        }
    }

    public function update()
    {
        $validateData = $this->validate();

        Donation::where('id', $this->donation_id)->update([
            'donatur_id' => $this->donatur_id,
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
        $proofs = BuktiSumbangan::where('donation_id', $this->donation_id)->get();

        // dd($proofs);

        if ($proofs) {
            foreach ($proofs as $proof) {
                unlink(public_path('storage/' . $proof->file));
            }
        }

        BuktiSumbangan::where('donation_id', $this->donation_id)->delete();
        Donation::destroy($this->donation_id);

        $this->dispatchBrowserEvent('deleted', ['message' => 'Donasi Berhasil Dihapus']);
    }
}
