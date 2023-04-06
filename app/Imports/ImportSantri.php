<?php

namespace App\Imports;

use App\Models\AnakAsuh;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;

class ImportSantri implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */

    public function model(array $row)
    {
        if (!array_filter($row)) {
            return null;
        }

        return new AnakAsuh([
            'id' => Str::uuid(),
            'nis' => $row[0],
            'nik' => $row[1],
            'nama_lengkap' => $row[2],
            'jenis_kelamin' => $row[3],
            'tempat_lahir' => $row[4],
            'tanggal_lahir' => Carbon::parse($row[5])->format('Y-m-d'),
            'pendidikan' => $row[6],
            'tipe' => $row[7],
            'alamat' => $row[8],
            'status' => $row[9],
            'tgl_masuk' => Carbon::parse($row[10])->format('Y-m-d'),
            'tgl_keluar' => Carbon::parse($row[11])->format('Y-m-d'),
            'nama_ayah_kandung' => $row[12],
            'nama_ibu_kandung' => $row[13],
            'nohp_ortu' => $row[14],
            'pemilik_nohp' => $row[15],
            'wali_anak' => $row[16],
        ]);
    }
}
