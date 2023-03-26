<?php

namespace App\Exports;

use App\Models\Donation;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnWidths;

class DonasiTunaiExport implements FromView, WithColumnWidths
{
    use Exportable;

    public function view(): View
    {
        $donations = Donation::with('donaturName')->where('jenis_donasi', 'Tunai')->get();

        return view('export.donasi-tunai.excel', [
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
        ];
    }
}