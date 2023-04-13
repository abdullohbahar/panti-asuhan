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

        return new LksaFinance([
            'tanggal' => $tgl_donasi,
            'keterangan' => $row[1],
            'pemasukan' => $row[2],
            'pengeluaran' => $row[3],
            'transaksi' => $row[4],
        ]);
    }
}
