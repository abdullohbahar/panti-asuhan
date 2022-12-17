<?php

namespace Database\Seeders;

use App\Models\Donatur;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class DonaturTableSeeder extends Seeder
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
            Donatur::create([
                'id' => $faker->uuid,
                'nama' => $faker->name,
                'alamat' => $faker->address,
            ]);
        }
    }
}
