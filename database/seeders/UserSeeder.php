<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'username' => 'owner',
            'email' => 'alitkj10@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'owner',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('users')->insert([
            'username' => 'pegawai',
            'email' => 'alimarket1910@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'pegawai',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
