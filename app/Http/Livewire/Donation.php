<?php

namespace App\Http\Livewire;

use PDF;
use Carbon\Carbon;
use App\Models\Donatur;
use App\Models\Invoice;
use Livewire\Component;
use Livewire\WithPagination;
use App\Exports\DonationExport;
use App\Models\TotalDanaDonation;
use Illuminate\Support\Facades\File;
use App\Models\Donation as ModelsDonation;

class Donation extends Component
{
    public $donation_id, $donatur_id, $pemasukan, $tanggal_donasi, $keterangan, $search, $date1, $date2, $filterDonaturId, $tipe, $terbilang, $nama_donatur, $no_hp, $alamat;
    public $donation_type_id = "Dana";
    protected $listeners = ['deleteConfirmed' => 'destroy', 'sendConfirmed' => 'send'];
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

        $query = ModelsDonation::where('jenis_donasi', "tunai")->whereHas('donatur', function ($q) use ($search) {
            $q->where('nama', 'like', '%' . $this->search . '%');
        })->when($this->date1, function ($query) use ($date1, $date2) {
            $query->whereBetween('tanggal_donasi', [$this->date1, $this->date2]);
        })->when($this->filterDonaturId, function ($query) use ($filterDonaturId) {
            $query->whereHas('donatur', function ($query) use ($filterDonaturId) {
                $query->where('id', $this->filterDonaturId);
            });
        })->orderBy('tanggal_donasi', 'desc');

        $donations = $query->orderBy('tanggal_donasi', 'asc')->paginate(10);
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
            'nama_donatur' => 'required',
            'pemasukan' => 'required',
            'tanggal_donasi' => 'required',
            'keterangan' => ''
        ];
    }

    public function messages()
    {
        return [
            'pemasukan.required' => 'Nominal harus diisi',
            'nama_donatur.required' => 'Donatur harus diisi',
            'tanggal_donasi' => 'Tanggal harus diisi',
        ];
    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function resetInput()
    {
        $this->nama_donatur = '';
        $this->tanggal_donasi = '';
        $this->keterangan = '';
        $this->pemasukan = '';
    }

    public function show($id, $donaturs)
    {
        $donation = ModelsDonation::find($id);

        if ($donation) {
            $this->donation_id = $donation->id;
            $this->pemasukan = "Rp. " . number_format($donation->pemasukan, 0, '', '.');
            $this->tanggal_donasi = $donation->tanggal_donasi;
            $this->terbilang = $donation->terbilang;
            $this->keterangan = $donation->keterangan;
            $this->tipe = $donation->tipe;
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

        // Update data
        ModelsDonation::where('id', $this->donation_id)->update([
            'donatur_id' => $this->donatur_id,
            'pemasukan' => $pemasukan,
            'tanggal_donasi' => $this->tanggal_donasi,
            'keterangan' => $this->keterangan,
            'tipe' => $this->tipe,
            'terbilang' => $this->terbilang,
        ]);

        Donatur::where('id', $this->donatur_id)->update([
            'nama' => $this->nama_donatur,
            'no_hp' => $this->no_hp,
            'alamat' => $this->alamat
        ]);

        $data = [
            'donation_id' => $this->donation_id,
            'donatur_id' => $this->donatur_id,
            'pemasukan' => $pemasukan,
            'tanggal_donasi' => $this->tanggal_donasi,
            'keterangan' => $this->keterangan,
            'tipe' => $this->tipe,
            'terbilang' => $this->terbilang,
        ];

        $encode = json_encode($data);

        // $this->dispatchBrowserEvent('close-modal', ['message' => 'Donasi Berhasil Diubah']);
        return redirect()->to('update-tanda-terima-tunai/' . $encode)->with('message', 'Donasi berhasil ditambahkan');
    }

    public function updateSendWa($data)
    {
        $data = json_decode($data);
        $donatur = Donatur::where('id', $data->donatur_id)->first();
        $date = date(now());

        $getData = ModelsDonation::find($data->donation_id);

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
            'nominal' => $data->pemasukan,
            'terbilang' => $data->terbilang,
            'tanggal' => Carbon::parse($date)->translatedFormat('d F Y'),
            'tipe' => $data->tipe,
            'keterangan' => $data->keterangan,
        ];

        $name = 'invoice/Tanda Terima - ' . $no . ' - ' . $donatur->nama . '.pdf';

        $pdf = PDF::loadView('invoice', $data);
        $pdf->setPaper('F4', 'potrait');
        $pdf->setOptions(['dpi' => 96, 'defaultFont' => 'sans-serif']);
        $pdf->save($name);

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.fonnte.com/send',
            CURLOPT_SSL_VERIFYPEER => FALSE,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array(
                'target' => '085701223722',
                'message' => 'test message',
                'url' => 'https://demo-panti.baharudinabdulloh.site/invoice/invoice_2.pdf',
                // 'url' => $name,
                // 'filename' => 'my-file.pdf',
                'countryCode' => '62', //optional
            ),
            CURLOPT_HTTPHEADER => array(
                'Authorization: mfS1xFJqr4XeXm48TvjV' //change TOKEN to your actual token
            ),
        ));

        Invoice::create([
            'donation_id' => $data['id'],
            'file' => $name
        ]);

        $response = curl_exec($curl);

        curl_close($curl);

        return redirect()->to('data-donasi-tunai')->with('message', 'Berhasil');
    }

    public function sendConfirmation($id)
    {
        $this->donation_id = $id;
        $this->dispatchBrowserEvent('show-send-confirmation');
    }

    public function send()
    {
        $data = ModelsDonation::find($this->donation_id);

        $data = [
            'donation_id' => $data->id,
            'donatur_id' => $data->donatur_id,
            'pemasukan' => $data->pemasukan,
            'tanggal_donasi' => $data->tanggal_donasi,
            'keterangan' => $data->keterangan,
            'tipe' => $data->tipe,
            'terbilang' => $data->terbilang,
        ];

        $encode = json_encode($data);

        return redirect()->to('update-tanda-terima-tunai/' . $encode)->with('message', 'Berhasil dikirim ulang');
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
        ModelsDonation::destroy($this->donation_id);
        $this->dispatchBrowserEvent('deleted', ['message' => 'Donasi Berhasil Dihapus']);
    }

    public function search()
    {
        $this->resetPage();
    }
}
