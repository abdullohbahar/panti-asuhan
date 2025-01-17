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
            'username' => 'admin-yayasan',
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

        User::create([
            'username' => 'bendahara-yayasan',
            'password' => Hash::make("password"),
            'role' => 'bendahara-yayasan',
            'foto' => 'default.jpg'
        ]);

        User::create([
            'username' => 'admin-donasi',
            'password' => Hash::make("password"),
            'role' => 'admin-donasi',
            'foto' => 'default.jpg'
        ]);

        User::create([
            'username' => 'sekertariat-yayasan',
            'password' => Hash::make("password"),
            'role' => 'sekertariat-yayasan',
            'foto' => 'default.jpg'
        ]);

        User::create([
            'username' => 'ketua-lksa',
            'password' => Hash::make("password"),
            'role' => 'ketua-lksa',
            'foto' => 'default.jpg'
        ]);

        User::create([
            'username' => 'bendahara-lksa',
            'password' => Hash::make("password"),
            'role' => 'bendahara-lksa',
            'foto' => 'default.jpg'
        ]);

        User::create([
            'username' => 'sekertariat-lksa',
            'password' => Hash::make("password"),
            'role' => 'sekertariat-lksa',
            'foto' => 'default.jpg'
        ]);

        User::create([
            'username' => 'penerima-donasi',
            'password' => Hash::make("password"),
            'role' => 'penerima-donasi',
            'foto' => 'default.jpg'
        ]);
    }
}
