<?php

namespace App\Http\Livewire;

use App\Models\Donation;
use App\Models\Donatur;
use App\Models\GoodsDonation;
use Livewire\Component;

class DonasiTransfer extends Component
{
    public $donatur_id, $tanggal_donasi, $nominal, $terbilang, $bank, $norek, $keterangan;

    public function render()
    {
        $data = [
            'donaturs' => Donatur::orderBy('nama', 'asc')->get(),
        ];

        return view('livewire.donasi-transfer', $data);
    }

    public function rules()
    {
        return [
            'donatur_id' => 'required',
            'tanggal_donasi' => 'required',
            'nominal' => 'required',
            'terbilang' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'donatur_id.required' => 'Nama donatur harus diisi',
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

        Donation::create([
            'donatur_id' => $this->donatur_id,
            'jenis_donasi' => 'Transfer',
            'terbilang' => $this->terbilang,
            'pemasukan' => $nominal,
            'keterangan' => $this->keterangan,
            'tanggal_donasi' => $this->tanggal_donasi,
            'bank' => $this->bank,
            'norek' => $this->norek,
        ]);

        return redirect()->to('data-donasi-transfer')->with('message', 'Donasi berhasil ditambahkan');
    }
}
