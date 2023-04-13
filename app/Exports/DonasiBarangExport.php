<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use App\Models\Donation;
use App\Models\GoodsDonation;

class DonasiBarangExport implements FromView, WithColumnWidths
{
    use Exportable;

    public function view(): View
    {
        $donations = GoodsDonation::with('donatur', 'detail')->get();

        return view('export.donasi-barang.excel', [
            'donations' => $donations,
        ]);
    }

    public function columnWidths(): array
    {
        return [
            'B' => 30,
            'C' => 30,
            'D' => 30,
            'E' => 30,
            'F' => 60,
            'G' => 40,
            'H' => 60,
        ];
    }
}
