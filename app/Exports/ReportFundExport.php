<?php

namespace App\Exports;

use App\Models\ReportFund;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;

class ReportFundExport implements FromView
{
    use Exportable;

    public function view(): View
    {
        return view('cetak-laporan-penggunaan-dana', [
            'reports' => ReportFund::get()
        ]);
    }
}
