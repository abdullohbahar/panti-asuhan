<?php

namespace App\Exports;

use App\Models\Citizen;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnWidths;

class WargaExport implements FromView, WithColumnWidths
{
    use Exportable;

    protected $status = '';

    public function __construct($status)
    {
        $this->status = $status;
    }

    public function view(): View
    {
        $wargas = Citizen::where('status', $this->status)->get();

        return view('export.cetak-warga-excel', [
            'wargas' => $wargas,
        ]);
    }

    public function columnWidths(): array
    {
        return [
            'B' => 30,
            'C' => 30,
            'D' => 30,
            'E' => 30,
            'F' => 30,
            'G' => 30,
            'H' => 30,
            'I' => 30,
        ];
    }
}
