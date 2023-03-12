<?php

namespace Database\Seeders;

use App\Models\MasterDataBank;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MasterDataBankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $banks = [
            'Bank Mandiri',
            'Bank Central Asia (BCA)',
            'Bank Rakyat Indonesia (BRI)',
            'Bank Negara Indonesia (BNI)',
            'Bank CIMB Niaga',
            'Bank Danamon',
            'Bank Permata',
            'Bank OCBC NISP',
            'Bank Tabungan Negara (BTN)',
            'Bank Mega',
            'Bank Bukopin',
            'Bank Syariah Mandiri',
            'Bank Muamalat',
            'Bank BRI Syariah',
            'Bank BNI Syariah',
            'Bank BCA Syariah',
            'Bank Mega Syariah',
            'Bank Mandiri Syariah',
        ];

        foreach ($banks as $bank) {
            MasterDataBank::create([
                'name' => $bank,
            ]);
        }
    }
}
