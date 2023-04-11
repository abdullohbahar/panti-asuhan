<?php

namespace App\Imports;

use Carbon\Carbon;
use App\Models\Donation;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class ImportPengeluaranYayasan implements ToModel, WithStartRow
{

    public function startRow(): int
    {
        return 2;
    }

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        if (!array_filter($row)) {
            return null;
        }

        if (strpos($row[0], '-')) {
            $tgl_donasi = Carbon::parse($row[0])->format('Y-m-d');
        } else if (ctype_digit($row[0])) {
            $tgl_donasi = Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[0]));
        } else {
            $tgl_donasi = NULL;
        }

        return new Donation([
            'tanggal_donasi' => $tgl_donasi,
            'pengeluaran' => $row[2],
            'jenis_donasi' => 'pengeluaran',
            'keterangan' => $row[1],
            'transaksi' => 'pengeluaran',
            'penerima' => ' '
        ]);
    }
}
