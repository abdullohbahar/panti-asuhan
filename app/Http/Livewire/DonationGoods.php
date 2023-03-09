<?php

namespace App\Http\Livewire;

use PDF;
use Exception;
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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Models\ProofOfDonationNumber;
use Illuminate\Support\Facades\Storage;


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

        try {
            DB::beginTransaction();

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

            $checkName = ProofOfDonationNumber::where('donation_id', $this->donation_id)->first();

            if ($checkName->name) {
                ProofOfDonationNumber::where('donation_id', $this->donation_id)->increment('name', 1);
            } else {
                ProofOfDonationNumber::where('donation_id', $this->donation_id)->update([
                    'name' => '1'
                ]);
            }

            $data = [
                'tanggal_donasi' => $this->tanggal_donasi,
                'nama' => $this->nama,
                'alamat' => $this->alamat,
                'keterangan' => $this->keterangan
            ];

            DB::commit();

            $this->kirimBukti($data);

            return redirect()->route('donation.goods')->with([
                'message' => 'Donasi berhasil ditambahkan',
                'id' => $this->donation_id
            ]);
        } catch (Exception $e) {
            Log::debug($e);
            DB::rollBack();
            return redirect()->route('donation.goods')->with([
                'error' => 'Ooops, ada yang error. Silahkan Hubungi Developer',
            ]);
        }
    }

    public function kirimBukti($data)
    {
        $nama = strtoupper($data['nama']);
        $tgl = Carbon::parse($data['tanggal_donasi'])->format('d-m-Y');
        $waktu = Carbon::now()->format('H:i:s');
        $alamat = $data['alamat'];
        $keterangan = $data['keterangan'];

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
                'message' => "DONASI BARANG \nDIUBAH \n$tgl $waktu \n$nama \nAlamat: $alamat \n$keterangan",
                'countryCode' => '62', //optional
            ),
            CURLOPT_HTTPHEADER => array(
                'Authorization: mfS1xFJqr4XeXm48TvjV' //change TOKEN to your actual token
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
    }

    public function deleteConfirmation($id)
    {
        $this->donation_id = $id;
        $this->dispatchBrowserEvent('show-delete-confirmation');
    }

    public function destroy()
    {
        $proofs = BuktiSumbangan::where('goods_donations_id', $this->donation_id)->get();

        if ($proofs) {
            foreach ($proofs as $proof) {
                unlink(public_path('storage/' . $proof->file));
            }
            BuktiSumbangan::where('goods_donations_id', $this->donation_id)->delete();
        }

        GoodsDonation::destroy($this->donation_id);

        $this->dispatchBrowserEvent('deleted', ['message' => 'Donasi Berhasil Dihapus']);
    }
}
