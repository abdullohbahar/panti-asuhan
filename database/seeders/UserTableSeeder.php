<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'username' => 'superadmin',
            'password' => Hash::make("password"),
            'role' => 'admin-yayasan',
            'foto' => 'default.jpg'
        ]);

        User::create([
            'username' => 'pembina-yayasan',
            'password' => Hash::make("password"),
            'role' => 'pembina-yayasan',
            'foto' => 'default.jpg'
        ]);

        User::create([
            'username' => 'ketua-yayasan',
            'password' => Hash::make("password"),
            'role' => 'ketua-yayasan',
            'foto' => 'default.jpg'
        ]);
    }
}
