<?php

namespace App\Exports;

use App\Models\LksaFinance;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnWidths;

class IncomeLksaExport implements FromView, WithColumnWidths
{
    use Exportable;

    public function view(): View
    {
        $lksas = LksaFinance::where('transaksi', 'pemasukan')->get();

        return view('export.pemasukan-lksa.excel', [
            'lksas' => $lksas,
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