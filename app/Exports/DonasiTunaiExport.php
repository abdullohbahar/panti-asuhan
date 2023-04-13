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

    public $date1;
    public $date2;
    public $type;

    public function __construct($date1, $date2, $type)
    {
        $this->date1 = $date1;
        $this->date2 = $date2;
        $this->type = $type;
    }

    public function view(): View
    {
        $donations = Donation::with('donaturName')
            ->where('jenis_donasi', 'Tunai')
            ->whereBetween('tanggal_donasi', [$this->date1, $this->date2])
            ->when($this->type != 'all', function ($query) {
                $query->where('tipe', $this->type);
            })
            ->orderBy('tanggal_donasi', 'desc')
            ->get();

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
