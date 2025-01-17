<?php

namespace App\Exports;

use Carbon\Carbon;
use App\Models\AnakAsuh;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Border;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class AnakAsuhExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithEvents, WithColumnWidths
{

    protected $tipe = '';

    public function __construct($tipe)
    {
        $this->tipe = $tipe;
    }

    protected $no = 1;

    public function headings(): array
    {
        return [
            'No',
            'Foto',
            'Nomor Induk Santri',
            'Nomor Induk Keluarga',
            'Nama',
            'Jenis Kelamin',
            'Tempat, Tanggal Lahir',
            'Usia',
            'Pendidikan',
            'Tipe',
            'Alamat',
            'Status',
            'Tanggal Masuk',
            'Tanggal Keluar',
            'Nama Ayah Kandung',
            'Nama Ibu Kandung',
            'Nomor HP Wali',
            'Nama Wali',
            'Rekomendasi / Penanggung Jawab',
        ];
    }

    public function map($item): array
    {
        return [
            $this->no++,
            '',
            $item->nis,
            $item->nik,
            $item->nama_lengkap,
            $item->jenis_kelamin,
            $item->tempat_lahir . ', ' . $item->tanggal_lahir,
            Carbon::parse($item->tanggal_lahir)->age,
            $item->pendidikan,
            $item->tipe,
            $item->alamat,
            $item->status,
            $item->tgl_masuk,
            $item->tgl_keluar,
            $item->nama_ayah_kandung,
            $item->nama_ibu_kandung,
            $item->nohp_ortu,
            $item->pemilik_nohp,
            $item->wali_anak,
        ];
    }

    public function collection()
    {
        return AnakAsuh::where('tipe', $this->tipe)->get();

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
