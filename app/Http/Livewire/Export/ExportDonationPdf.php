<?php

namespace App\Http\Livewire\Export;

use PDF;
use Livewire\Component;
use App\Models\Donation;
use Illuminate\Http\Request;

class ExportDonationPdf extends Component
{
    public $type;
    public $date1;
    public $date2;

    public function render()
    {
        return view('livewire.export.export-donation-pdf');
    }

    public function rules()
    {
        return [
            'date1' => 'required',
            'date2' => 'required',
            'type' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'date1.required' => 'Tanggal harus diisi',
            'date2.required' => 'Tanggal harus diisi',
            'type.required' => 'Tipe harus diisi',
        ];
    }

    public function update($fields)
    {
        $this->validateOnly($fields);
    }

    public function exportValidation()
    {
        $this->validate();

        return redirect()->to("export-donasi-pdf/$this->date1/$this->date2/$this->type");
    }

    public function export($date1, $date2, $type)
    {
        $donations = Donation::with('donaturName')
            ->where('jenis_donasi', 'Tunai')
            ->whereBetween('tanggal_donasi', [$date1, $date2])
            ->when($type != 'all', function ($query) use ($type) {
                $query->where('tipe', $type);
            })
            ->orderBy('tanggal_donasi', 'desc')
            ->get();

        $data = [
            'donations' => $donations
        ];

        $pdf = PDF::loadView('export.donasi-tunai.pdf', $data);

        $pdf->setPaper('F4', 'potrait');
        $pdf->setOptions(['dpi' => 96, 'defaultFont' => 'sans-serif']);
        $this->dispatchBrowserEvent('close-modal', ['message' => 'Berhasil']);

        return $pdf->download('Donasi Tunai.pdf');
    }
}
