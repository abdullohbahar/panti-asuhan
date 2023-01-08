<?php

namespace App\Http\Livewire;

use PDF;
use Carbon\Carbon;
use App\Models\Unit;
use App\Models\Donatur;
use App\Models\Invoice;
use Livewire\Component;
use App\Models\Donation;
use Livewire\WithPagination;
use App\Models\GoodsDonation;
use Livewire\WithFileUploads;
use App\Models\BuktiSumbangan;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;


class DonationGoods extends Component
{
    use WithFileUploads;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $donation_id, $donatur_id, $tanggal_donasi, $keterangan, $search, $jumlah, $satuan, $nama, $no_hp, $alamat, $idDonaturs;
    protected $listeners = ['deleteConfirmed' => 'destroy'];


    public function render()
    {
        $search = '';

        $donaturs = Donatur::orderBy('nama', 'asc')->get();

        $query = GoodsDonation::whereHas('donatur', function ($q) use ($search) {
            $q->where('nama', 'like', '%' . $this->search . '%')
                ->orwhere('tanggal_donasi', 'like', '%' . $this->search . '%')
                ->orwhere('keterangan', 'like', '%' . $this->search . '%');
        })->orderBy('tanggal_donasi', 'desc');

        $donations = $query->paginate(10);
        $count = $donations->count();

        $units = Unit::get();

        $data = [
            'donaturs' => $donaturs,
            'donations' => $donations,
            'count' => $count,
            'units' => $units
        ];

        return view('livewire.donation-goods', $data);
    }

    public function rules()
    {
        return [
            'donatur_id' => 'required',
            'tanggal_donasi' => 'required',
            'keterangan' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'donatur_id.required' => 'Donatur harus diisi',
            'tanggal_donasi.required' => 'Tanggal harus diisi',
            'keterangan.required' => 'Keterangan harus diisi',
        ];
    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function store()
    {
        $validateData = $this->validate();

        $donation = Donation::orderBy('no', 'desc')->first();
        $goodsDonation = GoodsDonation::orderBy('no', 'desc')->first();

        // Melakukan pengecekan untuk penomoran
        // jika donasi not null dan donasi barang null maka nomor urut diambil dari tabel donasi
        if ($donation && $goodsDonation == null) {
            $no = str_pad($donation->no + 1, 5, 0, STR_PAD_LEFT);

            // Selain itu jika donasi barang not null dan donasi barang null maka nomor urut diambil dari tabel donasi barang
        } elseif ($goodsDonation && $donation == null) {
            $no = str_pad($goodsDonation->no + 1, 5, 0, STR_PAD_LEFT);

            // jika donasi barang dan donasi not null
            // maka lakukan perbandingan apakah nomor di tabel donasi lebih besar
            // jika nomor di tabel donasi lebih besar maka menggunakan nomor dari donasi
            // jika nomor di tabel donasi barang maka menggunakan nomor dari donasi barang
        } elseif ($goodsDonation && $donation) {
            if ($donation->no > $goodsDonation->no) {
                $no = str_pad($donation->no + 1, 5, 0, STR_PAD_LEFT);
            } else {
                $no = str_pad($goodsDonation->no + 1, 5, 0, STR_PAD_LEFT);
            }

            // jika semua null maka nomor dimulai dari 1
        } elseif ($donation == null && $goodsDonation == null) {
            $no = '00001';
        }

        $data = GoodsDonation::create([
            'donatur_id' => $this->donatur_id,
            'no' => $no,
            'tanggal_donasi' => $this->tanggal_donasi,
            'keterangan' => $this->keterangan,
        ]);

        return redirect()->to('send-tanda-terima-barang/' . $data)->with('message', 'Donasi berhasil ditambahkan');
    }

    public function saveInvoice($data)
    {
        // membuat bulan menjadi romawi
        $array_bln = array(1 => "I", "II", "III", "IV", "V", "VI", "VII", "VIII", "IX", "X", "XI", "XII");
        $bln = $array_bln[date('n')];

        $data = json_decode($data);
        $donatur = Donatur::where('id', $data->donatur_id)->first();
        $date = date(now());

        $no = $data->no;

        $data = [
            'id' => $data->id,
            'nama' => $donatur->nama,
            'no' => $data->no,
            'tanggal' => Carbon::parse($date)->translatedFormat('d F Y'),
            'keterangan' => $data->keterangan,
            'alamat' => $donatur->alamat,
            'no_hp' => $donatur->no_hp,
            'bulan' => $bln,
        ];

        $name = 'invoice/Tanda Terima - ' . $no . ' - ' . $donatur->nama . '.pdf';

        $pdf = PDF::loadView('invoice-barang', $data);
        $pdf->setPaper('F4', 'potrait');
        $pdf->setOptions(['dpi' => 96, 'defaultFont' => 'sans-serif']);
        $pdf->save($name);

        Invoice::create([
            'donation_id' => $data['id'],
            'file' => $name
        ]);

        return redirect()->to('donasi-barang')->with('message', 'Donasi berhasil ditambahkan');
    }

    public function resetInput()
    {
        $this->donatur_id = '';
        $this->tanggal_donasi = '';
        $this->keterangan = '';
        $this->jumlah = '';
        $this->satuan = '';
    }

    public function show($id, $idDonatur)
    {
        $donation = GoodsDonation::find($id);
        $donatur = Donatur::find($idDonatur);

        if ($donatur) {
            $this->idDonaturs = $donatur->id;
            $this->nama = $donatur->nama;
            $this->no_hp = $donatur->no_hp;
            $this->alamat = $donatur->alamat;
        }

        if ($donation) {
            $this->donation_id = $donation->id;
            $this->donatur_id = $donation->donatur_id;
            $this->tanggal_donasi = $donation->tanggal_donasi;
            $this->keterangan = $donation->keterangan;
        }
    }

    public function update()
    {
        $validateData = $this->validate();

        GoodsDonation::where('id', $this->donation_id)->update([
            'donatur_id' => $this->donatur_id,
            'tanggal_donasi' => $this->tanggal_donasi,
            'keterangan' => $this->keterangan,
        ]);

        Donatur::where('id', $this->idDonaturs)->update([
            'nama' => $this->nama,
            'no_hp' => $this->no_hp,
            'alamat' => $this->alamat,
        ]);

        $data = [
            'donation_id' => $this->donation_id,
            'donatur_id' => $this->donatur_id,
            'tanggal_donasi' => $this->tanggal_donasi,
            'keterangan' => $this->keterangan,
        ];

        $encode = json_encode($data);

        return redirect()->to('update-tanda-terima-barang/' . $encode)->with('message', 'Donasi berhasil ditambahkan');
    }

    public function updateInvoice($data)
    {
        // membuat bulan menjadi romawi
        $array_bln = array(1 => "I", "II", "III", "IV", "V", "VI", "VII", "VIII", "IX", "X", "XI", "XII");
        $bln = $array_bln[date('n')];

        $data = json_decode($data);

        $donatur = Donatur::where('id', $data->donatur_id)->first();
        $date = date(now());

        $getData = GoodsDonation::find($data->donation_id);

        $no = $getData->no;

        $invoice = Invoice::where('donation_id', $data->donation_id)->first();

        if ($invoice) {
            if (File::exists($invoice->file)) {
                unlink($invoice->file);
            }
            $invoice->delete();
        }

        $data = [
            'id' => $data->donation_id,
            'nama' => $donatur->nama,
            'no' => $no,
            'tanggal' => Carbon::parse($date)->translatedFormat('d F Y'),
            'keterangan' => $data->keterangan,
            'alamat' => $donatur->alamat,
            'no_hp' => $donatur->no_hp,
            'bulan' => $bln,
        ];

        $name = 'invoice/Tanda Terima - ' . $no . ' - ' . $donatur->nama . '.pdf';

        $pdf = PDF::loadView('invoice-barang', $data);
        $pdf->setPaper('F4', 'potrait');
        $pdf->setOptions(['dpi' => 96, 'defaultFont' => 'sans-serif']);
        $pdf->save($name);

        Invoice::create([
            'donation_id' => $data['id'],
            'file' => $name
        ]);

        return redirect()->to('donasi-barang')->with('message', 'Berhasil');
    }

    public function printInvoice($id)
    {
        $invoice = Invoice::where('donation_id', $id)->first();
        return response()->download(public_path($invoice->file));
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
