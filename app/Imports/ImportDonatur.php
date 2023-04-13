<?php

namespace App\Imports;

use App\Models\Donatur;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class ImportDonatur implements ToModel, WithStartRow
{
    public function startRow(): int
    {
        return 2;
    }

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

        return new Donatur([
            'nama' => $row[0] ?? '',
            'alamat' => $row[1] ?? '',
            'no_hp' => $row[2] ?? '',
        ]);
    }
}
