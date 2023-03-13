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

        try {
            DB::beginTransaction();

            $createDoantur = Donatur::create([
                'nama' => $this->nama_donatur,
                'no_hp' => $this->no_hp,
                'alamat' => $this->alamat,
            ]);

            Donation::create([
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

            DB::commit();
            return redirect()->route('data.donasi.transfer')->with('message', 'Donasi berhasil ditambahkan');
        } catch (Exception $e) {
            Log::debug($e);
            DB::rollBack();
            $this->dispatchBrowserEvent('show-error', ['message' => 'Error, Coba untuk input data lagi atau hubungi developer']);
        }
    }
}
