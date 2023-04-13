<?php

namespace App\Exports;

use Carbon\Carbon;
use App\Models\AnakAsuh;
use App\Models\Pengurus;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use Maatwebsite\Excel\Concerns\WithColumnWidths;

class PengurusExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithEvents, WithColumnWidths
{

    protected $no = 1;

    protected $status;

    public function __construct($status)
    {
        $this->status = $status;
    }

    public function headings(): array
    {
        return [
            'No',
            'Foto',
            'NIK',
            'Nama',
            'Masa Bakti',
            'Jenis Kelamin',
            'Tempat, Tanggal Lahir',
            'Usia',
            'Pendidikan',
            'Alamat',
            'Nomor HP',
            'Jabatan',
            'Status',
            'Pekerjaan',
        ];
    }

    public function map($item): array
    {
        return [
            $this->no++,
            '',
            $item->nik,
            $item->nama,
            \Carbon\Carbon::parse($item->from)->format('d-m-Y') . ' Sampai ' . \Carbon\Carbon::parse($item->to)->format('d-m-Y'),
            $item->jenis_kelamin,
            $item->tempat_lahir . ', ' . $item->tanggal_lahir,
            Carbon::parse($item->tanggal_lahir)->age,
            $item->pendidikan,
            $item->alamat,
            $item->no_hp,
            $item->jabatan,
            $item->status,
            $item->pekerjaan,
        ];
    }

    public function collection()
    {
        return Pengurus::where('status', $this->status)->get();

        // return view('cetak-data-anak-asuh', [
        //     'anakAsuhs' => $anakAsuhs,
        // ]);
    }

    public function setImage($workSheet)
    {
        $this->collection()->each(function ($child, $index) use ($workSheet) {
            $drawing = new Drawing();
            if ($child->foto != null) {
                $drawing->setPath(public_path('storage/' . $child->foto));
            } else {
                $drawing->setPath(public_path('template/dist/img/default-picture.png'));
            }
            $drawing->setHeight(70);
            $index += 2;
            $drawing->setCoordinates("B$index");
            $drawing->setWorksheet($workSheet);
        });
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->getDefaultRowDimension()->setRowHeight(80);
                $workSheet = $event->sheet->getDelegate();
                $this->setImage($workSheet);
            }
        ];
    }

    public function columnWidths(): array
    {
        return [
            'B' => 20
        ];
    }
}
