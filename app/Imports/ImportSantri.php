<?php

namespace App\Imports;

use App\Models\AnakAsuh;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class ImportSantri implements ToModel, WithStartRow
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

        // dd($row[5]);

        return new AnakAsuh([
            'id' => Str::uuid(),
            'nis' => $row[0],
            'nik' => $row[1],
            'nama_lengkap' => $row[2], // required
            'jenis_kelamin' => $row[3], // required
            'tempat_lahir' => $row[4],
            'tanggal_lahir' => $row[5] != null ? Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[5])) : '',
            'pendidikan' => $row[6],
            'tipe' => $row[7], // required
            'alamat' => $row[8],
            'status' => $row[9], // required
            'tgl_masuk' => Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[10])),
            'tgl_keluar' => Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[11])),
            'nama_ayah_kandung' => $row[12],
            'nama_ibu_kandung' => $row[13],
            'nohp_ortu' => $row[14],
            'pemilik_nohp' => $row[15],
            'wali_anak' => $row[16],
        ]);
    }
}
