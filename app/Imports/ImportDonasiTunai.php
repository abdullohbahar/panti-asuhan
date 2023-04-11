<?php

namespace App\Imports;

use Carbon\Carbon;
use App\Models\Donatur;
use App\Models\Donation;
use Illuminate\Support\Collection;
use App\Models\ProofOfDonationNumber;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;

class ImportDonasiTunai implements ToCollection, WithStartRow
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
            if (!empty($row[0])) {
                // melakukan pengecekan apakh nomor null atau tidak
                $checkNomor = ProofOfDonationNumber::orderBy('no', 'desc')->first();

                if ($checkNomor) {
                    $monthDate = Carbon::now()->format('m-d');
                    if ($monthDate == '01-01') {
                        $no = '00001';
                    } else {
                        $no = str_pad($checkNomor->no + 1, 5, 0, STR_PAD_LEFT);
                    }
                } else {
                    $no = '00001';
                }

                if (strpos($row[4], '-')) {
                    $tgl_donasi = Carbon::parse($row[4])->format('Y-m-d');
                } else if (ctype_digit($row[4])) {
                    $tgl_donasi = Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[4]));
                } else {
                    $tgl_donasi = NULL;
                }

                $donatur = Donatur::create([
                    'nama' => $row[0],
                    'alamat' => $row[1] ?? '',
                    'no_hp' => $row[2] ?? '',
                ]);

                $donation = Donation::create([
                    'donatur_id' => $donatur->id,
                    'tipe' => $row[3],
                    'tanggal_donasi' => $tgl_donasi,
                    'pemasukan' => $row[5],
                    'transaksi' => 'pemasukan',
                    'penerima' => $row[6],
                    'keterangan' => $row[7],
                    'jenis_donasi' => 'Tunai'
                ]);

                ProofOfDonationNumber::create([
                    'donation_id' => $donation->id,
                    'no' => $no,
                ]);
            }
        }
    }
}
