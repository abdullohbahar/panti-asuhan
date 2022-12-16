<?php

namespace Database\Seeders;

use App\Models\Donation;
use App\Models\Donatur;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class DonationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id ID');
        for ($i = 0; $i < 50; $i++) {
            Donation::create([
                'id' => $faker->uuid,
                // 'donatur_id' => $faker->randomElement(['ab8a81f2-2a18-352a-b2ba-a2fcfd05f1de', 'a176985c-35b7-354a-8dfe-5b5f5ebf1106', 'ee1279be-ec7c-3c4a-9b32-f58933125367', '21b89b9c-2444-3cf0-b656-5f046b054abb']),
                'donatur_id' => Donatur::all()->random()->id,
                'donation_type_id' => 'Dana',
                'nominal' => $faker->randomFloat($min = 10000, $max = 1000000),
                'keterangan' => $faker->shuffleString,
                'tanggal_sumbangan' => $faker->date
            ]);
        }
    }
}
