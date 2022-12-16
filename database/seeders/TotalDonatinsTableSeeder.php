<?php

namespace Database\Seeders;

use App\Models\Donation;
use App\Models\TotalDanaDonation;
use App\Models\TotalDonation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TotalDonatinsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TotalDanaDonation::create([
            'total' => Donation::sum('nominal')
        ]);
    }
}
