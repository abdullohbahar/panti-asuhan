<?php

namespace App\Exports;

use Carbon\Carbon;
use App\Models\LksaFinance;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithEvents;
use PhpOffice\PhpSpreadsheet\Style\Border;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithPreCalculateFormulas;

class IncomeAndExpenseExport implements FromView, WithEvents, WithPreCalculateFormulas
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

        $query = LksaFinance::when($date1 != 0, function ($query) use ($date1, $date2) {
            $query->whereBetween('tanggal', [$date1, $date2]);
        })->orderBy('tanggal', 'asc');

        $date = Carbon::parse($date1)->subMonth();
        $subMonth = $date->lastOfMonth()->format('Y-m-d');

        $pemasukanBulanSebelumnya = LksaFinance::whereBetween('tanggal', ['2000-01-01', $subMonth])->sum("pemasukan");
        $pengeluaranBulanSebelumnya = LksaFinance::whereBetween('tanggal', ['2000-01-01', $subMonth])->sum("pengeluaran");

        $saldoBulanSebelumnya = $pemasukanBulanSebelumnya - $pengeluaranBulanSebelumnya;

        $image_path = public_path('logo/kop.png');

        $image_data = base64_encode(file_get_contents($image_path));

        $data = [
            'donations' => $query->get(),
            'pemasukan' => $query->sum('pemasukan'),
            'pengeluaran' => $query->sum('pengeluaran'),
            'saldoBulanSebelumnya' => $saldoBulanSebelumnya,
            'image' => $image_data,
        ];

        return view('cetak-laporan-pemasukan-pengeluaran-excel-lksa', $data);
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->getDelegate()->getStyle('A1:F1')->getAlignment()->setWrapText(true);
                // kolom header
                $event->sheet->getDelegate()->getStyle('A3:F3')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('D2D3D4');

                $event->sheet->getDelegate()->getStyle('A' . ($this->count + 5))->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
                $event->sheet->getDelegate()->getStyle('D' . ($this->count + 5))->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
                $event->sheet->getDelegate()->mergeCells('A' . ($this->count + 5) . ':C' . ($this->count + 5));
                // $event->sheet->getDelegate()->mergeCells('D' . ($this->count + 5) . ':F' . ($this->count + 5));
                // $event->sheet->getDelegate()->setCellValue('A' . ($this->count + 5), 'Saldo Akhir');
                // $event->sheet->getDelegate()->setCellValue('D' . ($this->count + 5), '=SUM(D5:D' . ($this->count + 5) . ') - SUM(E5:E' . ($this->count + 5) . ')');
                // $event->sheet->getStyle('D5:D' . ($this->count))->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_CURRENCY_USD_SIMPLE);
                // $event->sheet->getDefaultRowDimension()->setRowHeight(80);
                $event->sheet->getStyle('A2:F2')->getBorders()->getTop()
                    ->setBorderStyle(Border::BORDER_DOUBLE)
                    ->setColor(new \PhpOffice\PhpSpreadsheet\Style\Color('000000'));
                $drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
                $drawing->setName('My logo');
                $drawing->setDescription('My logo');
                $drawing->setPath(public_path('logo/kop.png'));
                $drawing->setWidth(707);
                $drawing->setCoordinates('C1');
                $drawing->setOffsetX(-100);
                $drawing->setWorksheet($event->sheet->getDelegate());
            },
        ];
    }
}
