<?php

namespace App\Http\Livewire;

use App\Http\Livewire\Donation as LivewireDonation;
use PDF;
use Carbon\Carbon;
use App\Models\Donatur;
use App\Models\Invoice;
use Livewire\Component;
use App\Models\Donation;
use App\Models\GoodsDonation;
use App\Models\ProofOfDonationNumber;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class DonasiTunai extends Component
{
    public $nama_donatur, $no_hp, $alamat, $tanggal_donasi, $nominal, $terbilang, $keterangan, $tipe, $penerima;
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
            'penerima' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'nama_donatur.required' => 'Nama donatur harus diisi',
            'tanggal_donasi.required' => 'Tanggal sumbangan harus diisi',
            'nominal.required' => 'Nominal harus diisi',
            'terbilang.required' => 'Terbilang harus diisi',
            'penerima.required' => 'Penerima harus diisi',
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

            $createDonation = Donation::create([
                'donatur_id' => $createDoantur->id,
                'jenis_donasi' => 'Tunai',
                'terbilang' => $this->terbilang,
                'pemasukan' => $nominal,
                'keterangan' => $this->keterangan,
                'tipe' => $this->tipe,
                'tanggal_donasi' => $this->tanggal_donasi,
                'transaksi' => 'pemasukan',
                'penerima' => $this->penerima,
            ]);

            ProofOfDonationNumber::create([
                'donation_id' => $createDonation->id,
                'no' => $no,
            ]);

            DB::commit();

            $data = [
                'tanggal_donasi' => $this->tanggal_donasi,
                'nama' => $this->nama_donatur,
                'nominal' => $nominal,
                'alamat' => $this->alamat,
                'penerima' => $this->penerima,
            ];

            $this->kirimBukti($data);
            if (auth()->user()->role != 'penerima-donasi') {
                return redirect()->route('donation.tunai')->with([
                    'message' => 'Donasi berhasil ditambahkan',
                    'id' => $createDonation->id
                ]);
            } else {
                return redirect()->route('dashboard.penerima.donasi')->with([
                    'message' => 'Donasi berhasil ditambahkan',
                    'id' => $createDonation->id
                ]);
            }
        } catch (Exception $e) {
            DB::rollBack();
            Log::debug($e);
            $this->dispatchBrowserEvent('show-error', ['message' => 'Error, Coba untuk input data lagi atau hubungi developer']);
        }
    }

    public function kirimBukti($data)
    {
        $nama = strtoupper($data['nama']);
        $tgl = Carbon::parse($data['tanggal_donasi'])->format('d-m-Y');
        $nominal = "Rp. " . number_format($data['nominal'], 2, ',', '.');
        $waktu = Carbon::now()->format('H:i:s');
        $alamat = $data['alamat'];
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
                'message' => "DONASI TUNAI \nBERHASIL \n$tgl $waktu \n$nama \nAlamat: $alamat \n$nominal \nPenerima: $penerima",
                'countryCode' => '62', //optional
            ),
            CURLOPT_HTTPHEADER => array(
                'Authorization: ' . env('FONNTE_TOKEN') . '' //change TOKEN to your actual token
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
    }

    public function downloadTemplate()
    {
        return response()->download(public_path('template/import/template import donasi tunai.xlsx'));
    }
}
