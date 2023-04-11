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

        if (strpos($row[5], '-')) {
            $tgl_lahir = Carbon::parse($row[5])->format('Y-m-d');
        } else if (ctype_digit($row[5])) {
            $tgl_lahir = Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[5]));
        } else {
            $tgl_lahir = '';
        }

        if (strpos($row[10], '-')) {
            $tgl_masuk = Carbon::parse($row[10])->format('Y-m-d');
        } else if (ctype_digit($row[10])) {
            $tgl_masuk = Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[10]));
        } else {
            $tgl_masuk = '';
        }

        if (strpos($row[11], '-')) {
            $tgl_keluar = Carbon::parse($row[11])->format('Y-m-d');
        } else if (ctype_digit($row[11])) {
            $tgl_keluar = Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[11]));
        } else {
            $tgl_keluar = '';
        }

        return new AnakAsuh([
            'id' => Str::uuid(),
            'nis' => $row[0],
            'nik' => $row[1],
            'nama_lengkap' => $row[2], // required
            'jenis_kelamin' => $row[3], // required
            'tempat_lahir' => $row[4],
            'tanggal_lahir' => $tgl_lahir,
            'pendidikan' => $row[6],
            'tipe' => $row[7], // required
            'alamat' => $row[8],
            'status' => $row[9], // required
            'tgl_masuk' => $tgl_masuk,
            'tgl_keluar' => $tgl_keluar,
            'nama_ayah_kandung' => $row[12],
            'nama_ibu_kandung' => $row[13],
            'nohp_ortu' => $row[14],
            'pemilik_nohp' => $row[15],
            'wali_anak' => $row[16],
        ]);
    }
}
