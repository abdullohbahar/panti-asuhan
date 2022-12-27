<?php

namespace App\Exports;

use App\Models\Donation;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithPreCalculateFormulas;

class LaporanPemasukanPengeluaranExport implements FromView, WithEvents, WithPreCalculateFormulas
{
    protected $no = 1;
    private $date1;
    private $date2;
    protected $count;

    use Exportable;

    public function __construct($date1, $date2)
    {
        $this->date1 = $date1;
        $this->date2 = $date2;
    }

    public function view(): View
    {
        // $date1 = request()->input('date1');
        // $date2 = request()->input('date2');
        $date1 = $this->date1;
        $date2 = $this->date2;

        $donations = Donation::when($this->date1 != 0, function ($query) use ($date1, $date2) {
            $query->whereBetween('tanggal_donasi', [$this->date1, $this->date2]);
        })->where('jenis_donasi', '=', "Tunai")->orWhere('jenis_donasi', '=', 'pengeluaran')->orWhere('jenis_donasi', '=', 'transfer')->orderBy('tanggal_donasi', 'asc')->get();

        $this->count = $donations->count();
        return view('cetak-laporan-pemasukan-pengeluaran-excel', [
            'donations' => $donations,
            'pemasukan' => $donations->sum('pemasukan'),
            'pengeluaran' => $donations->sum('pengeluaran'),
        ]);
    }

    // public function collection()
    // {
    //     $date1 = $this->date1;
    //     $date2 = $this->date2;

    //     return Donation::when($this->date1 != 0, function ($query) use ($date1, $date2) {
    //         $query->whereBetween('tanggal_donasi', [$this->date1, $this->date2]);
    //     })->where('jenis_donasi', '=', "Tunai")->orWhere('jenis_donasi', '=', 'pengeluaran')->orWhere('jenis_donasi', '=', 'transfer')->get();
    // }

    // public function headings(): array
    // {
    //     return [
    //         [
    //             'hello'
    //         ],
    //         [
    //             ''
    //         ],
    //         [
    //             'No',
    //             'Tanggal',
    //             'Uraian',
    //             'Pemasukan',
    //             'Pengeluaran',
    //         ],
    //     ];
    // }

    // public function startRow(): int
    // {
    //     return 2;
    // }

    // public function map($item): array
    // {
    //     return [
    //         $this->no++,
    //         $item->tanggal_donasi,
    //         $item->keterangan,
    //         $item->pemasukan,
    //         $item->pengeluaran,
    //     ];
    // }

    // public function columnWidths(): array
    // {
    //     return [
    //         'B' => 13,
    //         'C' => 50,
    //         'D' => 13,
    //         'E' => 13,
    //     ];
    // }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $cellRange = 'C'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getAlignment()->setWrapText(true);
                $event->sheet->getDelegate()->getStyle('A3:E3')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('D2D3D4');
                $event->sheet->getDelegate()->getStyle('A' . ($this->count + 5))->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
                $event->sheet->getDelegate()->getStyle('D' . ($this->count + 5))->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
                $event->sheet->getDelegate()->mergeCells('A' . ($this->count + 5) . ':C' . ($this->count + 5));
                $event->sheet->getDelegate()->mergeCells('D' . ($this->count + 5) . ':E' . ($this->count + 5));
                $event->sheet->getDelegate()->setCellValue('A' . ($this->count + 5), 'Saldo Akhir');
                $event->sheet->getDelegate()->setCellValue('D' . ($this->count + 5), '=SUM(D4:D' . ($this->count + 5) . ') - SUM(E4:E' . ($this->count + 5) . ')');
                // $event->sheet->getDefaultRowDimension()->setRowHeight(80);
                // $drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
                // $drawing->setName('My logo');
                // $drawing->setDescription('My logo');
                // $drawing->setPath(public_path('storage/akta/1.png'));
                // $drawing->setHeight(90);
                // $drawing->setCoordinates('A1');
                // $drawing->setOffsetX(10);
                // $drawing->setOffsetY(5);
                // $drawing->setWorksheet($event->sheet->getDelegate());
            },
        ];
    }
}