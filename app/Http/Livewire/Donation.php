<?php

namespace App\Http\Livewire;

use App\Exports\DonationExport;
use App\Models\Donation as ModelsDonation;
use App\Models\Donatur;
use App\Models\TotalDanaDonation;
use Livewire\Component;
use Livewire\WithPagination;
use PDF;


class Donation extends Component
{
    public $donation_id, $donatur_id, $pemasukan, $tanggal_sumbangan, $keterangan, $search, $date1, $date2, $filterDonaturId;
    public $donation_type_id = "Dana";
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

        $query = ModelsDonation::where('jenis_donasi', "tunai")->orWhere('jenis_donasi', 'transfer')->whereHas('donatur', function ($q) use ($search) {
            $q->where('nama', 'like', '%' . $this->search . '%');
        })->when($this->date1, function ($query) use ($date1, $date2) {
            $query->whereBetween('tanggal_donasi', [$this->date1, $this->date2]);
        })->when($this->filterDonaturId, function ($query) use ($filterDonaturId) {
            $query->whereHas('donatur', function ($query) use ($filterDonaturId) {
                $query->where('id', $this->filterDonaturId);
            });
        });

        $donations = $query->paginate(10);
        $count = $donations->count();
        $totalDonation = TotalDanaDonation::first();

        $data = [
            'donaturs' => $donaturs,
            'donations' => $donations,
            'count' => $count,
            'totalDana' => $totalDonation
        ];

        return view('livewire.donation', $data);
    }

    public function rules()
    {
        return [
            'donatur_id' => 'required',
            'pemasukan' => 'required',
            'tanggal_sumbangan' => 'required',
            'keterangan' => ''
        ];
    }

    public function messages()
    {
        return [
            'pemasukan.required' => 'Nominal harus diisi',
            'donatur_id.required' => 'Donatur harus diisi',
            'tanggal_sumbangan' => 'Tanggal harus diisi',
            'hajat' => 'Hajat harus diisi',
        ];
    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function resetInput()
    {
        $this->donatur_id = '';
        $this->tanggal_donasi = '';
        $this->hajat = '';
        $this->keterangan = '';
        $this->pemasukan = '';
    }

    public function show($id)
    {
        $donation = ModelsDonation::find($id);

        if ($donation) {
            $this->donation_id = $donation->id;
            $this->donatur_id = $donation->donatur_id;
            $this->pemasukan = "Rp. " . number_format($donation->pemasukan, 0, '', '.');
            $this->tanggal_donasi = $donation->tanggal_donasi;
            $this->hajat = $donation->hajat;
            $this->keterangan = $donation->keterangan;
        }
    }

    public function update()
    {
        // Validate Data
        $validateData = $this->validate();

        // Ambil pemasukan donasi berdasarkan id
        $pemasukanDonation = ModelsDonation::where('id', $this->donation_id)->get('pemasukan');

        // hapus character
        $removeChar = ['R', 'p', '.', ','];
        $pemasukan = str_replace($removeChar, "", $this->pemasukan);

        // Update data
        ModelsDonation::where('id', $this->donation_id)->update([
            'donatur_id' => $this->donatur_id,
            'pemasukan' => $pemasukan,
            'tanggal_sumbangan' => $this->tanggal_sumbangan,
            'keterangan' => $this->keterangan,
        ]);

        // Ambil total donas
        $queryTotal = TotalDanaDonation::where('id', 1);
        $getTotal = $queryTotal->get();

        // kurangi total donasi yang ada dengan pemasukan donasi berdasarkan id sebelum diubah
        $countTotal = $getTotal[0]->total - $pemasukanDonation[0]->pemasukan;

        // tambah total donasi dengan pemasukan donasi berdasarkan id setelah diubah 
        $total = $countTotal + $pemasukan;

        // Update total donasi
        $updateTotal = $queryTotal->update([
            'total' => $total
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

    public function search()
    {
        $this->resetPage();
    }
}
