<?php

namespace Database\Seeders;

use App\Models\MasterDataPendidikan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MasterDataPendidikanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pendidikan = [
            'SD',
            'SMP',
            'SMA',
            'D3',
            'S1',
            'S2',
            'S3',
        ];

        foreach ($pendidikan as $value) {
            MasterDataPendidikan::create([
                'name' => $value,
            ]);
        }
    }
}
