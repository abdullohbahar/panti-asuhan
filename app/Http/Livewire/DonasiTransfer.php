<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use App\Models\Donatur;
use Livewire\Component;
use App\Models\Donation;
use App\Models\GoodsDonation;
use App\Models\MasterDataBank;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\ProofOfDonationNumber;
use Exception;
use Illuminate\Support\Facades\Log;
use PDF;
use Illuminate\Romans\Support\Facades\IntToRoman;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class DonasiTransfer extends Component
{
    public $nama_donatur, $no_hp, $alamat, $donatur_id, $tanggal_donasi, $nominal, $terbilang, $bank, $norek, $keterangan, $other_bank, $nomor_transaksi;

    public function showOtherBank()
    {
        if ($this->bank !== 'lainnya') {
            $this->other_bank = null;
        } else {
            $this->other_bank = "lainnya";
        }
    }

    public function render()
    {
        $banks = MasterDataBank::orderBy('name', 'asc')->get();

        $data = [
            'donaturs' => Donatur::orderBy('nama', 'asc')->get(),
            'banks' => $banks,
        ];

        return view('livewire.donasi-transfer', $data);
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
            'tanggal_donasi.required' => 'Tanggal donasi harus diisi',
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

        if ($this->bank == "lainnya") {
            $bank = $this->other_bank;
        } else {
            $bank = $this->bank;
        }

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
                'jenis_donasi' => 'Transfer',
                'terbilang' => $this->terbilang,
                'pemasukan' => $nominal,
                'keterangan' => $this->keterangan,
                'tanggal_donasi' => $this->tanggal_donasi,
                'bank' => $bank,
                'norek' => $this->norek,
                'transaksi' => 'pemasukan',
                'penerima' => $bank,
                'nomor_transaksi' => $this->nomor_transaksi,
            ]);

            ProofOfDonationNumber::create([
                'donation_id' => $createDonation->id,
                'no' => $no,
            ]);

            DB::commit();
            return redirect()->route('data.donasi.transfer')->with([
                'message' => 'Donasi berhasil ditambahkan',
                'id' => $createDonation->id
            ]);
        } catch (Exception $e) {
            Log::debug($e);
            DB::rollBack();
            $this->dispatchBrowserEvent('show-error', ['message' => 'Error, Coba untuk input data lagi atau hubungi developer']);
        }
    }

    public function downloadTemplate()
    {
        return response()->download(public_path('template/import/template import donasi transfer.xlsx'));
    }

    public function printInvoiceDonationTransfer($id)
    {
        $donation = Donation::with('number', 'donatur')->where('id', $id)->first();

        $image_path = public_path('logo/kop.png');

        $image_data = base64_encode(file_get_contents($image_path));

        $now = Carbon::now()->format('m');
        $romanMonth = IntToRoman::filter($now);

        $createdDate = Carbon::parse($donation->created_at)->format('d-m-Y H:i:s');

        $yearNow = Carbon::now()->format('Y');

        $qr = QrCode::size(100)->generate(
            "
Yayasan Al Dzikro Wukirsari Imogiri Bantul Yogyakarta\n
TANDA TERIMA\n
No : {$donation->number->no} / Kw-Al Dzikro / {$romanMonth} / {$yearNow}\n
\n
Telah Diterima Dari: {$donation->donatur->nama}\n
Alamat: {$donation->donatur->alamat}\n
Nomor HP: {$donation->donatur->no_hp}\n
Uang Sejumlah: Rp. " . number_format($donation->pemasukan, 0, '', '.') . "\n
Terbilang: {$donation->terbilang}\n
Jenis Donasi: {$donation->tipe}\n
Keterangan: {$donation->keterangan}\n
Penerima: {$donation->penerima}\n
Tanggal: {$createdDate}
            "
        );

        $data = [
            'nama' => $donation->donatur->nama,
            'no' => $donation->number->no ?? '',
            'nominal' => $donation->pemasukan,
            'nomor_rekening' => $donation->norek,
            'nomor_transaksi' => $donation->nomor_transaksi,
            'bank' => $donation->bank,
            'tanggal' => Carbon::now()->translatedFormat('d F Y'),
            'tipe' => $donation->tipe,
            'keterangan' => $donation->keterangan,
            'alamat' => $donation->donatur->alamat,
            'no_hp' => $donation->donatur->no_hp,
            'bulan' => $romanMonth,
            'image' => $image_data,
            'penerima' => $donation->penerima,
            'created_at' => $createdDate,
            'qr' => $qr
        ];

        if ($donation->number->name) {
            $nama = 'Revisi - ' . $donation->number->name . ' - Tanda Terima - ' . $donation->number->no . ' - ' . $donation->donatur->nama;
        } else {
            $nama = 'Tanda Terima Donasi Transfer - ' . $donation->number->no . ' - ' . $donation->donatur->nama;
        }

        // $customPaper = array(0, 0, 614.173, 473.667);
        $pdf = PDF::loadView('invoice-transfer', $data);
        // $pdf->set_paper('potrait');
        // $pdf->setPaper($customPaper);
        $pdf->setOptions(['dpi' => 96, 'defaultFont' => 'sans-serif']);

        return $pdf->stream($nama . '.pdf');

        // return $pdf->download($nama . '.pdf');
    }
}
