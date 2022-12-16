<?php

namespace App\Http\Livewire;

use App\Models\Donation as ModelsDonation;
use App\Models\Donatur;
use App\Models\TotalDanaDonation;
use Livewire\Component;
use Livewire\WithPagination;

class Donation extends Component
{
    public $donation_id, $donatur_id, $nominal, $tanggal_sumbangan, $keterangan, $search, $date1, $date2, $filterDonaturId;
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

        $query = ModelsDonation::where('donation_type_id', "Dana")->whereHas('donatur', function ($q) use ($search) {
            $q->where('nama', 'like', '%' . $this->search . '%');
        })->when($this->date1, function ($query) use ($date1, $date2) {
            $query->whereBetween('tanggal_sumbangan', [$this->date1, $this->date2]);
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
            'donation_type_id' => 'required',
            'nominal' => 'required',
            'tanggal_sumbangan' => 'required',
            'keterangan' => ''
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

        $removeChar = ['R', 'p', '.', ','];

        $validateData['nominal'] = str_replace($removeChar, "", $validateData['nominal']);

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
            $this->nominal = "Rp " . number_format($donation->nominal, 0, '', '.');
            $this->tanggal_sumbangan = $donation->tanggal_sumbangan;
            $this->keterangan = $donation->keterangan;
        }
    }

    public function update()
    {
        // Validate Data
        $validateData = $this->validate();

        // Ambil nominal donasi berdasarkan id
        $nominalDonation = ModelsDonation::where('id', $this->donation_id)->get('nominal');

        // hapus character
        $removeChar = ['R', 'p', '.', ','];
        $nominal = str_replace($removeChar, "", $this->nominal);

        // Update data
        ModelsDonation::where('id', $this->donation_id)->update([
            'donatur_id' => $this->donatur_id,
            'nominal' => $nominal,
            'tanggal_sumbangan' => $this->tanggal_sumbangan,
            'keterangan' => $this->keterangan,
        ]);

        // Ambil total donas
        $queryTotal = TotalDanaDonation::where('id', 1);
        $getTotal = $queryTotal->get();

        // kurangi total donasi yang ada dengan nominal donasi berdasarkan id sebelum diubah
        $countTotal = $getTotal[0]->total - $nominalDonation[0]->nominal;

        // tambah total donasi dengan nominal donasi berdasarkan id setelah diubah 
        $total = $countTotal + $nominal;

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

    public function print()
    {
        $search = '';
        $date1 = '';
        $date2 = '';
        $filterDonaturId = '';

        $query = ModelsDonation::where('donation_type_id', "Dana")->whereHas('donatur', function ($q) use ($search) {
            $q->where('nama', 'like', '%' . $this->search . '%');
        })->when($this->date1, function ($query) use ($date1, $date2) {
            $query->whereBetween('tanggal_sumbangan', [$this->date1, $this->date2]);
        })->when($this->filterDonaturId, function ($query) use ($filterDonaturId) {
            $query->whereHas('donatur', function ($query) use ($filterDonaturId) {
                $query->where('id', $this->filterDonaturId);
            });
        });

        $donations = $query->get();

        dump($donations);
    }
}
