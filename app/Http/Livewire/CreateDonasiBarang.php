<?php

namespace App\Http\Livewire;

use PDF;
use Exception;
use Carbon\Carbon;
use App\Models\Donatur;
use Livewire\Component;
use App\Models\GoodsDonation;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\Models\DetailGoodsDonation;
use Illuminate\Support\Facades\Log;
use App\Models\ProofOfDonationNumber;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Romans\Support\Facades\IntToRoman;

class CreateDonasiBarang extends Component
{
    public $nama_donatur, $no_hp, $alamat, $tanggal_donasi, $keterangan, $nama_barang, $jumlah, $penerima;

    public Collection $inputs;

    public function mount()
    {
        $this->fill([
            'inputs' => collect([[
                'nama_barang' => '',
                'jumlah' => ''
            ]]),
        ]);
    }

    public function render()
    {
        return view('livewire.create-donasi-barang');
    }

    public function addInput()
    {
        $this->inputs->push([
            'nama_barang' => '',
            'jumlah' => ''
        ]);
    }

    public function removeInput($key)
    {
        $this->inputs->pull($key);
    }

    public function rules()
    {
        return [
            'nama_donatur' => 'required',
            'tanggal_donasi' => 'required',
            'penerima' => 'required',
            'inputs.*.nama_barang' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'nama_donatur.required' => 'Nama donatur harus diisi',
            'tanggal_donasi.required' => 'Tanggal sumbangan harus diisi',
            'penerima.required' => 'Penerima harus diisi',
            'inputs.*.nama_barang.required' => 'Nama barang harus diisi',
        ];
    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function store()
    {
        $this->validate();

        // melakukan pengecekan apakh nomor null atau tidak
        $checkNomor = ProofOfDonationNumber::latest()->first();

        if ($checkNomor) {
            // jika nomor tidak null maka lakukan pengecekan apakah tahun yang latest dengan tahun sekarang sama
            // jika tidak sama maka ulani nomor menjadi 1
            $checkNomorYear = Carbon::parse($checkNomor->created_at)->format('Y');
            $yearNow = Carbon::now()->format('Y');
            if ($yearNow != $checkNomorYear) {
                $no = '00001';
            } else {
                $no = str_pad($checkNomor->no + 1, 5, 0, STR_PAD_LEFT);
            }
        } else {
            $no = '00001';
        }

        try {
            DB::beginTransaction();

            $createDoantur = Donatur::create([
                'nama' => $this->nama_donatur,
                'no_hp' => $this->no_hp,
                'alamat' => $this->alamat,
            ]);

            $createDonation = GoodsDonation::create([
                'donatur_id' => $createDoantur->id,
                'tanggal_donasi' => $this->tanggal_donasi,
                'penerima' => $this->penerima,
            ]);

            ProofOfDonationNumber::create([
                'donation_id' => $createDonation->id,
                'no' => $no,
            ]);

            $results = '';
            foreach ($this->inputs as $key => $value) {
                DetailGoodsDonation::create([
                    'nama_barang' => $this->inputs[$key]['nama_barang'],
                    'jumlah' => $this->inputs[$key]['jumlah'],
                    'goods_donations_id' => $createDonation->id
                ]);

                $results .= $this->inputs[$key]['nama_barang'] . ' ' . $this->inputs[$key]['jumlah'] . ', ';
            }

            $results = rtrim($results, ', ');

            $data = [
                'tanggal_donasi' => $this->tanggal_donasi,
                'nama' => $this->nama_donatur,
                'alamat' => $this->alamat,
                'keterangan' => $results,
                'penerima' => $this->penerima,
            ];

            $this->kirimBukti($data);
            DB::commit();

            if (auth()->user()->role == 'penerima-donasi') {
                return redirect()->route('dashboard.penerima.donasi')->with([
                    'message' => 'Donasi berhasil ditambahkan',
                    'idBarang' => $createDonation->id
                ]);
            } elseif (auth()->user()->role == 'admin-donasi') {
                return redirect()->route('dashboard.admin.donasi')->with([
                    'message' => 'Donasi berhasil ditambahkan',
                    'idBarang' => $createDonation->id
                ]);
            } else {
                return redirect()->route('donation.tunai')->with([
                    'message' => 'Donasi berhasil ditambahkan',
                    'idBarang' => $createDonation->id
                ]);
            }
        } catch (Exception $e) {
            Log::debug($e);
            DB::rollBack();
            $this->dispatchBrowserEvent('show-error', ['message' => 'Error, Coba untuk input data lagi atau hubungi developer']);
        }
    }

    public function kirimBukti($data)
    {
        $nama = strtoupper($data['nama']);
        $tgl = Carbon::parse($data['tanggal_donasi'])->format('d-m-Y');
        $waktu = Carbon::now()->format('H:i:s');
        $alamat = $data['alamat'];
        $keterangan = $data['keterangan'];
        $penerima = $data['penerima'];

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
                'target' => env('PHONE_NUMBER'),
                'message' => "DONASI BARANG \nBERHASIL \n$tgl $waktu \n$nama \nAlamat: $alamat \nKeterangan Barang: $keterangan \nPenerima: $penerima",
                'countryCode' => '62', //optional
            ),
            CURLOPT_HTTPHEADER => array(
                'Authorization: ' . env('FONNTE_TOKEN') . '' //change TOKEN to your actual token
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
    }

    public function printInvoiceDonation($id)
    {
        $donation = GoodsDonation::with('number', 'donatur')->where('id', $id)->first();

        $image_path = public_path('logo/kop.png');

        $image_data = base64_encode(file_get_contents($image_path));

        $now = Carbon::now()->format('m');
        $romanMonth = IntToRoman::filter($now);

        $keterangans = DetailGoodsDonation::where('goods_donations_id', $id)->get();

        $createdDate = Carbon::parse($donation->created_at)->format('d-m-Y H:i:s');

        // menggabungkan array menggunakan koma
        $results = '';
        foreach ($donation->details as $value) {
            $results .= $value->nama_barang . ' ' . $value->jumlah . ', ';
        }

        $results = rtrim($results, ', ');

        $yearNow = Carbon::now()->format('Y');

        $qr = QrCode::size(85)->generate(
            "
Yayasan Al Dzikro Wukirsari Imogiri Bantul Yogyakarta\n
TANDA TERIMA\n
No : {$donation->number->no} / Kw-Al Dzikro / {$romanMonth} / {$yearNow}\n
\n
Telah Diterima Dari: {$donation->donatur->nama}\n
Alamat: {$donation->donatur->alamat}\n
Nomor HP: {$donation->donatur->no_hp}\n
Keterangan: {$donation->keterangan}\n
Penerima: {$donation->penerima}\n
Tanggal: {$createdDate}\n
Detail Barang: {$results}\n
            "
        );

        $data = [
            'nama' => $donation->donatur->nama,
            'no' => $donation->number->no ?? '',
            'tanggal' => Carbon::now()->translatedFormat('d F Y'),
            'tipe' => $donation->tipe,
            'keterangans' => $keterangans,
            'alamat' => $donation->donatur->alamat,
            'no_hp' => $donation->donatur->no_hp,
            'bulan' => $romanMonth,
            'image' => $image_data,
            'penerima' => $donation->penerima,
            'created_at' => $createdDate,
            'qr' => $qr,
        ];

        if ($donation->number->name) {
            $nama = 'Revisi - ' . $donation->number->name . ' - Tanda Terima - ' . $donation->number->no . ' - ' . $donation->donatur->nama;
        } else {
            $nama = 'Tanda Terima - ' . $donation->number->no . ' - ' . $donation->donatur->nama;
        }

        $pdf = PDF::loadView('invoice-barang', $data);
        // $pdf->setPaper('F4', 'potrait');
        $pdf->setOptions(['dpi' => 96, 'defaultFont' => 'sans-serif']);

        return $pdf->stream($nama . '.pdf');
        // return $pdf->download($nama . '.pdf');
    }
}
