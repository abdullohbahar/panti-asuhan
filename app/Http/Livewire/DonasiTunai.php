<?php

namespace App\Http\Livewire;

use App\Models\Donatur;
use Livewire\Component;
use App\Models\Donation;
use App\Models\GoodsDonation;
use App\Models\Invoice;
use Carbon\Carbon;
use PDF;

class DonasiTunai extends Component
{
    public $nama_donatur, $no_hp, $alamat, $tanggal_donasi, $nominal, $terbilang, $keterangan, $tipe;
    public function render()
    {
        $data = [
            'donaturs' => Donatur::orderBy('nama', 'asc')->get(),
        ];

        return view('livewire.donasi-tunai', $data);
    }

    public function rules()
    {
        return [
            'nama_donatur' => 'required',
            'tanggal_donasi' => 'required',
            'nominal' => 'required',
            'terbilang' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'nama_donatur.required' => 'Nama donatur harus diisi',
            'tanggal_donasi.required' => 'Tanggal sumbangan harus diisi',
            'nominal.required' => 'Nominal harus diisi',
            'terbilang.required' => 'Terbilang harus diisi',
        ];
    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function store()
    {
        $this->validate();

        $removeChar = ['R', 'p', '.', ','];

        $nominal = str_replace($removeChar, "", $this->nominal);

        $nominal = str_replace(' ', '', $nominal);

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

        $createDoantur = Donatur::create([
            'nama' => $this->nama_donatur,
            'no_hp' => $this->no_hp,
            'alamat' => $this->alamat,
        ]);

        $data = Donation::create([
            'no' => $no,
            'donatur_id' => $createDoantur->id,
            'jenis_donasi' => 'Tunai',
            'terbilang' => $this->terbilang,
            'pemasukan' => $nominal,
            'keterangan' => $this->keterangan,
            'tipe' => $this->tipe,
            'tanggal_donasi' => $this->tanggal_donasi,
        ]);

        return redirect()->to('send-tanda-terima-tunai/' . $data)->with('message', 'Donasi berhasil ditambahkan');
    }

    public function sendWa($data)
    {
        $data = json_decode($data);
        $donatur = Donatur::where('id', $data->donatur_id)->first();
        $date = date(now());

        $no = $data->no;

        $data = [
            'id' => $data->id,
            'nama' => $donatur->nama,
            'no' => $data->no,
            'nominal' => $data->pemasukan,
            'terbilang' => $data->terbilang,
            'tanggal' => Carbon::parse($date)->translatedFormat('d F Y'),
            'tipe' => $data->tipe,
            'keterangan' => $data->keterangan,
        ];

        // dd($data);

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

        return redirect()->to('data-donasi-tunai')->with('message', 'Donasi berhasil ditambahkan');
    }
}
