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
        // dd($rows);
        foreach ($rows as $row) {
            if (!empty($row[0]) && !empty($row[1]) && !empty($row[2]) && !empty($row[3]) && !empty($row[4]) && !empty($row[5]) && !empty($row[6]) && !empty($row[7]) && !empty($row[8])) {
                if (strpos($row[3], '-')) {
                    $tgl_donasi = Carbon::parse($row[3])->format('Y-m-d');
                } else if (ctype_digit($row[3])) {
                    $tgl_donasi = Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[3]));
                } else {
                    $tgl_donasi = NULL;
                }

                $donatur = Donatur::create([
                    'nama' => $row[0] ?? '',
                    'alamat' => $row[1] ?? '',
                    'no_hp' => $row[2] ?? '',
                ]);

                $donation = Donation::create([
                    'donatur_id' => $donatur->id,
                    'tanggal_donasi' => $tgl_donasi,
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
}
