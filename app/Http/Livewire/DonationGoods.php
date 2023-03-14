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
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\Exports\DonasiBarangExport;
use App\Models\DetailGoodsDonation;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\ProofOfDonationNumber;
use Illuminate\Support\Facades\Storage;



class DonationGoods extends Component
{
    use WithFileUploads;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $donation_id, $donatur_id, $tanggal_donasi, $search, $jumlah, $satuan, $nama, $no_hp, $alamat, $idDonaturs, $penerima;
    protected $listeners = ['deleteConfirmed' => 'destroy'];
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
        $search = '';

        $donaturs = Donatur::orderBy('nama', 'asc')->get();

        $query = GoodsDonation::whereHas('donatur', function ($q) use ($search) {
            $q->where('nama', 'like', '%' . $this->search . '%')
                ->orwhere('tanggal_donasi', 'like', '%' . $this->search . '%');
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
            'donatur_id' => 'required',
            'tanggal_donasi' => 'required',
            'penerima' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'donatur_id.required' => 'Donatur harus diisi',
            'tanggal_donasi.required' => 'Tanggal harus diisi',
            'penerima.required' => 'Penerima harus diisi',
        ];
    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function show($id, $idDonatur)
    {
        $this->inputs = collect()->make();

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
            $this->penerima = $donation->penerima;
        }

        $details = DetailGoodsDonation::where('goods_donations_id', $this->donation_id)->get();

        foreach ($details as $detail) {
            $pushData = [
                'nama_barang' => $detail->nama_barang,
                'jumlah' => $detail->jumlah,
            ];
            $this->inputs->push($pushData);
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
                'penerima' => $this->penerima
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

            // cek apakah detail sudah ada
            $checkDetail = DetailGoodsDonation::where('goods_donations_id', $this->donation_id)->get();

            // jika ada maka hapus terlebih dahulu
            if ($checkDetail) {
                DetailGoodsDonation::where('goods_donations_id', $this->donation_id)->delete();
            }

            $results = '';
            foreach ($this->inputs as $key => $value) {
                DetailGoodsDonation::create([
                    'nama_barang' => $this->inputs[$key]['nama_barang'],
                    'jumlah' => $this->inputs[$key]['jumlah'],
                    'goods_donations_id' => $this->donation_id
                ]);

                $results .= $this->inputs[$key]['nama_barang'] . ' ' . $this->inputs[$key]['jumlah'] . ', ';
            }

            $results = rtrim($results, ', ');

            $data = [
                'tanggal_donasi' => $this->tanggal_donasi,
                'nama' => $this->nama,
                'alamat' => $this->alamat,
                'keterangan' => $results,
                'penerima' => $this->penerima,
            ];

            DB::commit();

            $this->kirimBukti($data);

            return redirect()->route('donation.goods')->with([
                'message' => 'Donasi berhasil diubah',
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
                'target' => '085701223722',
                'message' => "DONASI BARANG \nDIUBAH \n$tgl $waktu \n$nama \nAlamat: $alamat \nKeterangan Barang: $keterangan \nPenerima: $penerima",
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

    public function exportExcel()
    {
        return Excel::download(new DonasiBarangExport, 'Donasi Barang.xlsx');
    }

    public function exportPdf()
    {
        $donations = GoodsDonation::with('donatur', 'detail')->get();

        $data = [
            'donations' => $donations
        ];

        $pdf = PDF::loadView('export.donasi-barang.pdf', $data);
        $pdf->setPaper('F4', 'potrait');
        $pdf->setOptions(['dpi' => 96, 'defaultFont' => 'sans-serif']);

        return $pdf->download('Donasi Barang.pdf');
    }
}
