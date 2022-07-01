<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@tes.com',
            'password' => Hash::make('12345678'),
            'role_id' => 1,
        ]);
        User::create([
            'name' => 'Pimpinan',
            'email' => 'pimpinan@tes.com',
            'password' => Hash::make('12345678'),
            'role_id' => 2,
        ]);
        User::create([
            'name' => 'Operator',
            'email' => 'operator@tes.com',
            'password' => Hash::make('12345678'),
            'role_id' => 3,
        ]);
        User::create([
            'name' => 'Anggota',
            'email' => 'anggota@tes.com',
            'password' => Hash::make('12345678'),
            'role_id' => 4,
        ]);
    }
}
