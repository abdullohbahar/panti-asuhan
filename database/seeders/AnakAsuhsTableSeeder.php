<?php

namespace Database\Seeders;

use App\Models\AnakAsuh;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class AnakAsuhsTableSeeder extends Seeder
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
            AnakAsuh::create([
                'id' => $faker->uuid,
                'nama_lengkap' => $faker->name,
                'jenis_kelamin' => $faker->randomElement(['laki-laki', 'perempuan']),
                'status' => $faker->randomElement(['aktif', 'non-aktif']),
                'alamat' => $faker->address,
                'tempat_lahir' => $faker->address,
                'tanggal_lahir' => $faker->date,
            ]);
        }
    }
}
