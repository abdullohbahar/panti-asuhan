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
        return new Pengurus([
            'nik' => $row[1],
            'nama' => $row[2],
            'alamat' => $row[3],
            'no_hp' => $row[4],
            'tempat_lahir' => $row[5],
            'tanggal_lahir' => $row[6] != null ? Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[6])) : '',
            'jabatan' => $row[7],
            'jenis_kelamin' => $row[8],
            'pendidikan' => $row[9],
            'pekerjaan' => $row[10],
            'from' => $row[11] != null ? Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[11])) : '',
            'to' => $row[12] != null ? Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[12])) : '',
            'order' => $row[0],
            'status' => $row[13],
        ]);
    }
}
