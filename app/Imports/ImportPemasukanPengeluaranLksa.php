<?php

namespace App\Imports;

use Carbon\Carbon;
use App\Models\LksaFinance;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class ImportPemasukanPengeluaranLksa implements ToModel, WithStartRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */

    public function startRow(): int
    {
        return 2;
    }

    public function model(array $row)
    {
        return new LksaFinance([
            'tanggal' => $row[0] != null ? Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[0])) : NULL,
            'keterangan' => $row[1],
            'pemasukan' => $row[2],
            'pengeluaran' => $row[3],
            'transaksi' => $row[4],
        ]);
    }
}
