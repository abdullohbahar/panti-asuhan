<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Donation;
use App\Models\Donatur;
use Livewire\WithPagination;

class DataDonasiTransfer extends Component
{
    public $donation_id, $donatur_id, $pemasukan, $tanggal_donasi, $keterangan, $search, $date1, $date2, $filterDonaturId, $tipe, $terbilang, $bank, $norek;
    protected $listeners = ['deleteConfirmed' => 'destroy'];
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        // dump($this->filterDonaturId);
        $search = '';
        $date1 = '';
        $date2 = '';
        $filterDonaturId = '';

        $donaturs = Donatur::orderBy('nama', 'asc')->get();

        $query = Donation::where('jenis_donasi', "transfer")->whereHas('donatur', function ($q) use ($search) {
            $q->where('nama', 'like', '%' . $this->search . '%');
        })->when($this->date1, function ($query) use ($date1, $date2) {
            $query->whereBetween('tanggal_donasi', [$this->date1, $this->date2]);
        })->when($this->filterDonaturId, function ($query) use ($filterDonaturId) {
            $query->whereHas('donatur', function ($query) use ($filterDonaturId) {
                $query->where('id', $this->filterDonaturId);
            });
        });

        $donations = $query->orderBy('tanggal_donasi', 'asc')->paginate(10);
        $count = $donations->count();

        $data = [
            'donaturs' => $donaturs,
            'donations' => $donations,
            'count' => $count,
        ];

        return view('livewire.data-donasi-transfer', $data);
    }

    public function search()
    {
        $this->resetPage();
    }

    public function rules()
    {
        return [
            'donatur_id' => 'required',
            'pemasukan' => 'required',
            'tanggal_donasi' => 'required',
            'keterangan' => ''
        ];
    }

    public function messages()
    {
        return [
            'pemasukan.required' => 'Nominal harus diisi',
            'donatur_id.required' => 'Donatur harus diisi',
            'tanggal_donasi' => 'Tanggal harus diisi',
        ];
    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function show($id)
    {
        $donation = Donation::find($id);

        if ($donation) {
            $this->donation_id = $donation->id;
            $this->donatur_id = $donation->donatur_id;
            $this->pemasukan = "Rp. " . number_format($donation->pemasukan, 0, '', '.');
            $this->tanggal_donasi = $donation->tanggal_donasi;
            $this->terbilang = $donation->terbilang;
            $this->keterangan = $donation->keterangan;
            $this->bank = $donation->bank;
            $this->norek = $donation->norek;
        }
    }

    public function update()
    {
        // Validate Data
        $validateData = $this->validate();

        // hapus character
        $removeChar = ['R', 'p', '.', ','];
        $pemasukan = str_replace($removeChar, "", $this->pemasukan);

        // Update data
        Donation::where('id', $this->donation_id)->update([
            'donatur_id' => $this->donatur_id,
            'pemasukan' => $pemasukan,
            'tanggal_donasi' => $this->tanggal_donasi,
            'terbilang' => $this->terbilang,
            'keterangan' => $this->keterangan,
            'bank' => $this->bank,
            'norek' => $this->norek,
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
        Donation::destroy($this->donation_id);
        $this->dispatchBrowserEvent('deleted', ['message' => 'Donasi Berhasil Dihapus']);
    }
}
