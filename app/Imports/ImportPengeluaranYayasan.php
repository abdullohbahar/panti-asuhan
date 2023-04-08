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

        return new Donation([
            'tanggal_donasi' => $row[0] != null ? Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[0])) : NULL,
            'pengeluaran' => $row[2],
            'jenis_donasi' => 'pengeluaran',
            'keterangan' => $row[1],
            'transaksi' => 'pengeluaran',
            'penerima' => ' '
        ]);
    }
}
