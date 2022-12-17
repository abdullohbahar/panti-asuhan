<?php

namespace App\Exports;

use App\Models\Donation;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;

class DonationExport implements FromView
{
    use Exportable;

    public function view(): View
    {
        $donation = Donation::where('donation_type_id', "dana")->whereHas('donatur')->get();

        return view('cetak-donasi-dana-excel', [
            'donations' => $donation,
        ]);
    }
}
