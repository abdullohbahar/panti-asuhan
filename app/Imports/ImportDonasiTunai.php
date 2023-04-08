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

            $donatur = Donatur::create([
                'nama' => $row[0],
                'alamat' => $row[1] ?? '',
                'no_hp' => $row[2] ?? '',
            ]);

            $donation = Donation::create([
                'donatur_id' => $donatur->id,
                'tipe' => $row[3],
                'tanggal_donasi' => $row[4] != null ? Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[4])) : NULL,
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
