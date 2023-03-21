<?php

namespace App\Http\Livewire;

use App\Exports\DonasiTunaiExport;
use PDF;
use Exception;
use Carbon\Carbon;
use App\Models\Donatur;
use App\Models\Invoice;
use Livewire\Component;
use Livewire\WithPagination;
use App\Exports\DonationExport;
use App\Models\TotalDanaDonation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\ProofOfDonationNumber;
use Illuminate\Database\QueryException;
use App\Models\Donation as ModelsDonation;
use Illuminate\Romans\Support\Facades\IntToRoman;

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
        });

        $donations = $query->orderBy('created_at', 'asc')->paginate(15);
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

        try {
            DB::beginTransaction();
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
                'nama' => $this->nama_donatur,
                'nominal' => $pemasukan,
                'alamat' => $this->alamat,
            ];

            DB::commit();

            $this->kirimBukti($data);

            return redirect()->route('donation.tunai')->with([
                'message' => 'Donasi berhasil ditambahkan',
                'id' => $this->donation_id
            ]);
        } catch (QueryException $e) {
            Log::debug($e);
            DB::rollBack();
            return redirect()->route('donation.tunai')->with([
                'error' => 'Ooops, ada yang error. Silahkan Hubungi Developer',
            ]);
        }
    }

    public function kirimBukti($data)
    {
        $nama = strtoupper($data['nama']);
        $tgl = Carbon::parse($data['tanggal_donasi'])->format('d-m-Y');
        $nominal = "Rp. " . number_format($data['nominal'], 2, ',', '.');
        $waktu = Carbon::now()->format('H:i:s');
        $alamat = $data['alamat'];

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
                'message' => "DONASI TUNAI \nDIUBAH \n$tgl $waktu \n$nama \nAlamat: $alamat \n$nominal",
                'countryCode' => '62', //optional
            ),
            CURLOPT_HTTPHEADER => array(
                'Authorization: mfS1xFJqr4XeXm48TvjV' //change TOKEN to your actual token
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
    }

    public function printInvoiceDonation($id)
    {
        $donation = ModelsDonation::with('number', 'donatur')->where('id', $id)->first();

        $image_path = public_path('logo/kop.png');

        $image_data = base64_encode(file_get_contents($image_path));

        $now = Carbon::now()->format('m');
        $romanMonth = IntToRoman::filter($now);

        $data = [
            'nama' => $donation->donatur->nama,
            'no' => $donation->number->no ?? '',
            'nominal' => $donation->pemasukan,
            'terbilang' => $donation->terbilang,
            'tanggal' => Carbon::now()->translatedFormat('d F Y'),
            'tipe' => $donation->tipe,
            'keterangan' => $donation->keterangan,
            'alamat' => $donation->donatur->alamat,
            'no_hp' => $donation->donatur->no_hp,
            'bulan' => $romanMonth,
            'image' => $image_data,
            'penerima' => $donation->penerima,
            'created_at' => $donation->created_at
        ];

        if ($donation->number->name) {
            $nama = 'Revisi - ' . $donation->number->name . ' - Tanda Terima - ' . $donation->number->no . ' - ' . $donation->donatur->nama;
        } else {
            $nama = 'Tanda Terima - ' . $donation->number->no . ' - ' . $donation->donatur->nama;
        }

        // $customPaper = array(0, 0, 614.173, 473.667);
        $pdf = PDF::loadView('invoice', $data);
        // $pdf->set_paper('potrait');
        // $pdf->setPaper($customPaper);
        $pdf->setOptions(['dpi' => 96, 'defaultFont' => 'sans-serif']);

        return $pdf->stream($nama . '.pdf');

        // return $pdf->download($nama . '.pdf');
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

    public function exportExcel()
    {
        return Excel::download(new DonasiTunaiExport, 'Donasi Tunai.xlsx');
    }

    public function exportPdf()
    {
        $donations = ModelsDonation::with('donaturName')->where('jenis_donasi', 'Tunai')->get();

        $data = [
            'donations' => $donations
        ];

        $pdf = PDF::loadView('export.donasi-tunai.pdf', $data);
        $pdf->setPaper('F4', 'potrait');
        $pdf->setOptions(['dpi' => 96, 'defaultFont' => 'sans-serif']);

        return $pdf->download('Donasi Tunai.pdf');
    }
}
