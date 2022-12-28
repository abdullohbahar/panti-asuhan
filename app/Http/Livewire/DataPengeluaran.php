<?php

namespace App\Http\Livewire;

use App\Models\Donation;
use Livewire\Component;
use Livewire\WithPagination;

class DataPengeluaran extends Component
{
    public $donatur_id, $pengeluaran, $tanggal_donasi, $keterangan, $search, $date1, $date2, $filterDonaturId;
    protected $listeners = ['deleteConfirmed' => 'destroy'];
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $search = '';
        $date1 = '';
        $date2 = '';
        $filterDonaturId = '';

        $query = Donation::where('jenis_donasi', "pengeluaran")->when($this->date1, function ($query) use ($date1, $date2) {
            $query->whereBetween('tanggal_donasi', [$this->date1, $this->date2]);
        });

        $donations = $query->orderBy('tanggal_donasi', 'asc')->paginate(10);
        $count = $donations->count();

        $data = [
            'donations' => $donations,
            'count' => $count,
        ];

        return view('livewire.data-pengeluaran', $data);
    }

    public function search()
    {
        $this->resetPage();
    }

    public function rules()
    {
        return [
            'pengeluaran' => 'required',
            'tanggal_donasi' => 'required',
            'keterangan' => ''
        ];
    }

    public function messages()
    {
        return [
            'pengeluaran.required' => 'Nominal harus diisi',
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
            $this->pengeluaran = "Rp. " . number_format($donation->pengeluaran, 0, '', '.');
            $this->tanggal_donasi = $donation->tanggal_donasi;
            $this->keterangan = $donation->keterangan;
        }
    }

    public function update()
    {
        // Validate Data
        $validateData = $this->validate();

        // hapus character
        $removeChar = ['R', 'p', '.', ','];
        $pengeluaran = str_replace($removeChar, "", $this->pengeluaran);

        // Update data
        Donation::where('id', $this->donation_id)->update([
            'pengeluaran' => $pengeluaran,
            'tanggal_donasi' => $this->tanggal_donasi,
            'keterangan' => $this->keterangan,
        ]);


        $this->dispatchBrowserEvent('close-modal', ['message' => 'Pengeluaran Berhasil Diubah']);
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
