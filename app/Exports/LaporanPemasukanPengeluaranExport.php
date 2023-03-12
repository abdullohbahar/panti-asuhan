<?php

namespace App\Exports;

use App\Models\Donation;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithEvents;
use PhpOffice\PhpSpreadsheet\Style\Border;
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
        $date1 = $this->date1;
        $date2 = $this->date2;

        // dd($date1, $date2);

        $donations = Donation::with('donaturName')->when($date1 != 0, function ($query) use ($date1, $date2) {
            $query->whereBetween('tanggal_donasi', [$date1, $date2]);
        })->orderBy('tanggal_donasi', 'asc')->get();

        $time = strtotime($this->date1);
        $monthNow = date("m", $time);
        $year = date("Y", $time);

        if ($monthNow == 01) {
            $monthBefore = 12;
            $year = $year - 1;
        } else {
            $monthBefore = $monthNow - 1;
        }


        $pemasukanBulanSebelumnya = Donation::whereMonth('tanggal_donasi', $monthBefore)->whereYear("tanggal_donasi", $year)->sum("pemasukan");
        $pengeluaranBulanSebelumnya = Donation::whereMonth('tanggal_donasi', $monthBefore)->whereYear("tanggal_donasi", $year)->sum("pengeluaran");

        $saldoBulanSebelumnya = $pemasukanBulanSebelumnya - $pengeluaranBulanSebelumnya;

        $image_path = public_path('logo/kop-with-line.png');

        $image_data = base64_encode(file_get_contents($image_path));

        $this->count = $donations->count();


        return view('cetak-laporan-pemasukan-pengeluaran-excel', [
            'donations' => $donations,
            'pemasukan' => $donations->sum('pemasukan'),
            'pengeluaran' => $donations->sum('pengeluaran'),
            'saldoBulanSebelumnya' => $saldoBulanSebelumnya,
            'image' => $image_data,
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

    // public function columnFormats(): array
    // {
    //     return [
    //         'D' => '[$Rp-421]#.##0'
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
                $event->sheet->getDelegate()->getStyle('A1:G1')->getAlignment()->setWrapText(true);
                // kolom header
                $event->sheet->getDelegate()->getStyle('A3:G3')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('D2D3D4');

                $event->sheet->getDelegate()->getStyle('A' . ($this->count + 6))->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
                $event->sheet->getDelegate()->getStyle('D' . ($this->count + 6))->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
                $event->sheet->getDelegate()->mergeCells('A' . ($this->count + 6) . ':C' . ($this->count + 6));
                // $event->sheet->getDelegate()->mergeCells('D' . ($this->count + 5) . ':F' . ($this->count + 5));
                // $event->sheet->getDelegate()->setCellValue('A' . ($this->count + 5), 'Saldo Akhir');
                // $event->sheet->getDelegate()->setCellValue('D' . ($this->count + 5), '=SUM(D5:D' . ($this->count + 5) . ') - SUM(E5:E' . ($this->count + 5) . ')');
                // $event->sheet->getStyle('D5:D' . ($this->count))->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_CURRENCY_USD_SIMPLE);
                // $event->sheet->getDefaultRowDimension()->setRowHeight(80);
                $event->sheet->getStyle('A2:G2')->getBorders()->getTop()
                    ->setBorderStyle(Border::BORDER_DOUBLE)
                    ->setColor(new \PhpOffice\PhpSpreadsheet\Style\Color('000000'));
                $drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
                $drawing->setName('My logo');
                $drawing->setDescription('My logo');
                $drawing->setPath(public_path('logo/kop.png'));
                $drawing->setWidth(707);
                $drawing->setCoordinates('C1');
                $drawing->setWorksheet($event->sheet->getDelegate());
            },
        ];
    }
}
