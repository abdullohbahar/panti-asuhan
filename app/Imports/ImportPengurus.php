<?php

namespace App\Imports;

use Carbon\Carbon;
use App\Models\Pengurus;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class ImportPengurus implements ToModel, WithStartRow
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

        if (strpos($row[6], '-')) {
            $tgl_lahir = Carbon::parse($row[6])->format('Y-m-d');
        } else if (ctype_digit($row[6])) {
            $tgl_lahir = Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[6]));
        } else {
            $tgl_lahir = NULL;
        }

        if (strpos($row[11], '-')) {
            $from = Carbon::parse($row[11])->format('Y-m-d');
        } else if (ctype_digit($row[11])) {
            $from = Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[11]));
        } else {
            $from = NULL;
        }

        if (strpos($row[12], '-')) {
            $to = Carbon::parse($row[12])->format('Y-m-d');
        } else if (ctype_digit($row[12])) {
            $to = Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[12]));
        } else {
            $to = NULL;
        }

        return new Pengurus([
            'nik' => $row[1],
            'nama' => $row[2],
            'alamat' => $row[3],
            'no_hp' => $row[4],
            'tempat_lahir' => $row[5],
            'tanggal_lahir' => $tgl_lahir,
            'jabatan' => $row[7],
            'jenis_kelamin' => $row[8],
            'pendidikan' => $row[9],
            'pekerjaan' => $row[10],
            'from' => $from,
            'to' => $to,
            'order' => $row[0],
            'status' => $row[13],
        ]);
    }
}
