<?php

namespace App\Exports;

use App\Models\Donatur;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnWidths;

class DonaturExport implements FromView, WithColumnWidths
{
    use Exportable;

    public function view(): View
    {
        $donaturs = Donatur::get();

        return view('cetak-donatur-excel', [
            'donaturs' => $donaturs,
        ]);
    }

    public function columnWidths(): array
    {
        return [
            'B' => 30,
            'C' => 60
        ];
    }
}
