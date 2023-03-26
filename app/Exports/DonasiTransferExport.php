<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use App\Models\Donation;

class DonasiTransferExport implements FromView, WithColumnWidths
{
    use Exportable;

    public function view(): View
    {
        $donations = Donation::with('donaturName')->where('jenis_donasi', 'Transfer')->get();

        return view('export.donasi-transfer.excel', [
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