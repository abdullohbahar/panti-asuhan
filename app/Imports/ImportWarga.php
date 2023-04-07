<?php

namespace App\Imports;

use Carbon\Carbon;
use App\Models\Citizen;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class ImportWarga implements ToModel, WithStartRow
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

        return new Citizen([
            'id' => Str::uuid(),
            'nik' => $row[0],
            'nama_lengkap' => $row[1], // required
            'jenis_kelamin' => $row[2], // required
            'tempat_lahir' => $row[3],
            'tanggal_lahir' => $row[4] != null ? Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[4])) : NULL,
            'alamat' => $row[5],
            'no_hp' => $row[6],
            'status' => $row[7], // required
        ]);
    }
}
