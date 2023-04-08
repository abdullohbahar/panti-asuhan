<?php

namespace App\Imports;

use Carbon\Carbon;
use App\Models\Donatur;
use App\Models\Donation;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;

class ImportDonasiTransfer implements ToCollection, WithStartRow
{
    public function startRow(): int
    {
        return 2;
    }

    /**
     * @param Collection $collection
     */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $donatur = Donatur::create([
                'nama' => $row[0] ?? '',
                'alamat' => $row[1] ?? '',
                'no_hp' => $row[2] ?? '',
            ]);

            $donation = Donation::create([
                'donatur_id' => $donatur->id,
                'tanggal_donasi' => $row[3] != null ? Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[3])) : NULL,
                'pemasukan' => $row[4],
                'bank' => $row[5],
                'norek' => $row[6],
                'nomor_transaksi' => $row[7],
                'transaksi' => 'pemasukan',
                'penerima' => $row[5] ?? '',
                'keterangan' => $row[8],
                'jenis_donasi' => 'Transfer',
            ]);
        }
    }
}
