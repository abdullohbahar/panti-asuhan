<?php

namespace App\Http\Livewire;

use App\Models\Donatur;
use Livewire\Component;
use App\Models\Donation;
use Livewire\WithPagination;
use App\Models\MasterDataBank;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DonasiTransferExport;
use PDF;

class DataDonasiTransfer extends Component
{
    public $nomor_transaksi, $nama_donatur, $no_hp, $alamat, $donation_id, $donatur_id, $pemasukan, $tanggal_donasi, $keterangan, $search, $date1, $date2, $filterDonaturId, $tipe, $terbilang, $bank, $norek, $other_bank;
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

        $query = Donation::where('jenis_donasi', "Transfer")->whereHas('donatur', function ($q) use ($search) {
            $q->where('nama', 'like', '%' . $this->search . '%');
        })->when($this->date1, function ($query) use ($date1, $date2) {
            $query->whereBetween('tanggal_donasi', [$this->date1, $this->date2]);
        })->when($this->filterDonaturId, function ($query) use ($filterDonaturId) {
            $query->whereHas('donatur', function ($query) use ($filterDonaturId) {
                $query->where('id', $this->filterDonaturId);
            });
        });

        $donations = $query->orderBy('tanggal_donasi', 'desc')->paginate(10);
        $count = $donations->count();

        $banks = MasterDataBank::orderBy('name', 'asc')->get();


        $data = [
            'donaturs' => $donaturs,
            'donations' => $donations,
            'count' => $count,
            'banks' => $banks,

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

    public function show($id, $donaturs)
    {
        $donation = Donation::find($id);
        $banks = MasterDataBank::where('name', $donation->bank)->first();

        if ($banks) {
            $this->bank = $donation->bank;
        } else {
            $this->bank = "lainnya";
            $this->other_bank = $donation->bank;
        }

        if ($donation) {
            $this->donation_id = $donation->id;
            $this->pemasukan = "Rp. " . number_format($donation->pemasukan, 0, '', '.');
            $this->tanggal_donasi = $donation->tanggal_donasi;
            $this->terbilang = $donation->terbilang;
            $this->keterangan = $donation->keterangan;
            $this->tipe = $donation->tipe;
            $this->norek = $donation->norek;
            $this->nomor_transaksi = $donation->nomor_transaksi;
        }

        $donatur = Donatur::find($donaturs);

        if ($donatur) {
            $this->donatur_id = $donatur->id;
            $this->nama_donatur = $donatur->nama;
            $this->no_hp = $donatur->no_hp;
            $this->alamat = $donatur->alamat;
        }
    }

    public function update()
    {
        // Validate Data
        $validateData = $this->validate();

        // hapus character
        $removeChar = ['R', 'p', '.', ','];
        $pemasukan = str_replace($removeChar, "", $this->pemasukan);

        if ($this->bank == "lainnya") {
            $bank = $this->other_bank;
        } else {
            $bank = $this->bank;
        }

        // Update data
        Donation::where('id', $this->donation_id)->update([
            'pemasukan' => $pemasukan,
            'tanggal_donasi' => $this->tanggal_donasi,
            'terbilang' => $this->terbilang,
            'keterangan' => $this->keterangan,
            'bank' => $bank,
            'norek' => $this->norek,
            'nomor_transaksi' => $this->nomor_transaksi,
        ]);

        Donatur::where('id', $this->donatur_id)->update([
            'nama' => $this->nama_donatur,
            'no_hp' => $this->no_hp,
            'alamat' => $this->alamat
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

    public function exportExcel()
    {
        return Excel::download(new DonasiTransferExport, 'Donasi Transfer.xlsx');
    }

    public function exportPdf()
    {
        $donations = Donation::with('donaturName')->where('jenis_donasi', 'Transfer')->get();

        $data = [
            'donations' => $donations
        ];

        $pdf = PDF::loadView('export.donasi-transfer.pdf', $data);
        $pdf->setPaper('F4', 'potrait');
        $pdf->setOptions(['dpi' => 96, 'defaultFont' => 'sans-serif']);

        return $pdf->download('Donasi Transfer.pdf');
    }
}
